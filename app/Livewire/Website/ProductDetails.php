<?php

namespace App\Livewire\Website;

use App\Models\CartItem;
use Livewire\Component;
use App\Models\Cart;

class ProductDetails extends Component
{
    public $product;
    public $variantId;
    public $quantity;
    public $price;


    public $cartQuantity = 1;
    public $productId;
    public $cartAttributesArray = [];


    public function mount($product)
    {
        $this->product = $product;
        $this->variantId = $product->has_variants ? $this->product->variants->first()->id : null;
        $this->price = $product->has_variants ? $this->product->variants->first()->price : null;
        $this->quantity = $product->has_variants ? $this->product->variants->first()->stock : $product->quantity;

    }

    public function changeVariant($variantId)
    {
        $variant = $this->product->variants->find($variantId);
        if (!$variant) {
            return response()->json([
                'message' => 'variant not valide',
            ], 404);
        }
        $this->changePropertiesValue($variant);
    }
    public function changePropertiesValue($variant)
    {
        $this->variantId = $variant->id;
        $this->price = $variant->price;
        $this->quantity = $variant->stock;
    }

    public function decrementCartQuantity()
    {
        if ($this->cartQuantity > 0) {
            $this->cartQuantity--;
        }
    }

    public function incrementCartQuantity()
    {
        $this->cartQuantity++;
    }

    public function addToCart()
    {
        $product = $this->product;
        $user = auth('web')->user();
        if (!$user) {
            return redirect()->route('website.showLogin'); 
        }

        $userId = $user->id;
        $cart = Cart::firstOrCreate(['user_id' => $userId]);

        if (!$product->has_variants) {
            $cartItem = CartItem::where('cart_id', $cart->id)
                ->where('product_id', $product->id)
                ->whereNull('product_variant_id')
                ->first();

            if($cartItem){
                $cartItem->increment('quantity',$this->cartQuantity);
            }else{
                $cart->cartItems()->create([
                    'product_id'=> $product->id,
                    'product_variant_id'=> null,
                    'quantity'=> $this->cartQuantity,
                    'price'=>$product->has_discount ? $product->price - $product->discount : $product->price,
                ]);
            }    
        }

        if($product->has_variants){
            $variant = $product->variants->find($this->variantId);
            $variant->load('VariantAttributes');

            $cartItem = CartItem::where('cart_id', $cart->id)
                ->where('product_variant_id',$variant->id)
                ->first();

                if($cartItem){
                $cartItem->increment('quantity',$this->cartQuantity);
            }else{
                foreach ($variant->VariantAttributes as $variantAttribute) {
                    $this->cartAttributesArray[$variantAttribute->attributeValue->attribute->name] = $variantAttribute->attributeValue->value;
                }
               $cart->cartItems()->create([
                    'product_id'=> $product->id,
                    'product_variant_id'=> $this->variantId,
                    'quantity'=> $this->cartQuantity,
                    'price'=>$variant->price,
                    'attributes'=>json_encode($this->cartAttributesArray,JSON_UNESCAPED_UNICODE)
                ]);
            } 
        }

        $this->dispatch('success', 'product add to cart');
        $this->dispatch('refreshCartIcon');

    }


    public function render()
    {
        return view(
            'livewire.website.product-details',
            [
                'variants' => $this->product->variants,
            ]
        );
    }
}
