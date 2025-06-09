<?php

namespace App\Services\Website;

use App\Models\City;
use App\Models\Country;
use App\Models\Coupon;
use App\Models\Governorate;
use App\Models\Cart;
use App\Models\ShippingGovernorate;
use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class OrderService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function getInvoiceValue($shipping){
        // محتاج اول حاجه ان انا اجيب الجفرن ريت نيم
        $governorateName = $this->getLocationName(Governorate::class, $shipping['governorate_id']);

        // ببدا ان انا اجيب الكارت الخاصه باليوزر
        // cart auth
        $cart = $this->getUserCart();
        if(!$cart || $cart->cartItems->isEmpty()){
            return null;
        }

        // هتجيب لي السعر الاجمالي اللي انا هدفعه ببوابه الدفع اللي هو عباره عن اسعار المنتجات الحاجات الموجوده عندي في الكارت زائد سعر الشحن
        $subTotal = $cart->cartItems->sum(fn($cartItem) => $cartItem->price * $cartItem->quantity);
        
        // سعر الشحن
        $shippingPrice = $this->getShippingPrice($shipping['governorate_id']);

        // check if user has coupon
        if($coupon_exists = $cart->coupon != null){ //  يعني في كوبون 
            $coupon = Coupon::valid()->where('code',trim($cart->coupon))->first();
            if($coupon){
                // هيغير قيمه السعر بعد ما يخصم
                $subTotal = $subTotal - ($subTotal * $coupon->discount_percentage / 100);
            }
        }
        $totalPrice = $subTotal + $shippingPrice;
        return $totalPrice;
    }


    public function createTransaction($data , $orderId){
        $transaction = Transaction::create([
            'user_id'=> Auth::guard('web')->user()->id,
            'order_id'=>$orderId,
            'transaction_id'=>$data['Data']['InvoiceId'],
            'payment_method'=> 'Payment',

        ]);
        return $transaction; 
    }

    public function createOrder(array $shipping): ?Order{
        // location name
        $countryName = $this->getLocationName(Country::class, $shipping['country_id']);
        $governorateName = $this->getLocationName(Governorate::class, $shipping['governorate_id']);
        $cityName = $this->getLocationName(City::class, $shipping['city_id']);

        if(!$countryName || !$governorateName || !$cityName){
            return null;
        }

        // cart auth
        $cart = $this->getUserCart();
        if(!$cart || $cart->cartItems->isEmpty()){
            return null;
        }

        // totalPrice 
        $subTotal = $cart->cartItems->sum(fn($cartItem) => $cartItem->price * $cartItem->quantity);
        $shippingPrice = $this->getShippingPrice($shipping['governorate_id']);

        // check if coupon
        if($coupon_exists = $cart->coupon != null){ //  يعني في كوبون 
            $coupon = Coupon::valid()->where('code',trim($cart->coupon))->first();
            if($coupon){
                $subTotal = $subTotal - ($subTotal * $coupon->discount_percentage / 100);
            }
        }
        $totalPrice = $subTotal + $shippingPrice;


        // store order
        $order = Order::create([
            'user_id'=> auth('web')->user()->id,
            'user_name'=>$shipping['first_name'] . ' ' . $shipping['last_name'],
            'user_phone'=>$shipping['user_phone'],
            'user_email'=>$shipping['user_email'],
            'country'=>$countryName,
            'governorate'=>$governorateName,
            'city'=>$cityName,
            'street'=>$shipping['street'],
            'note'=>$shipping['note'],
            'price'=>$subTotal,
            'shapping_price'=>$shippingPrice,
            'total_price'=>$totalPrice,
            'coupon'=>$coupon_exists && $coupon ? $coupon->code : null,
            'coupon_discount'=>$coupon_exists && $coupon ? $coupon->discount_percentage : 0,
     
        ]);

        // create order items
        $this->storeOrderItemFormCart($order , $cart);
        return $order;

    }


    private function getLocationName($modelClass , $id){
        return $modelClass::find($id)?->name;
    }

    private function getUserCart(){
        return Cart::with('cartItems.product')->where('user_id',auth('web')->user()->id)->first();
    }

    private function getShippingPrice($governorateId){
        return ShippingGovernorate::where('governorate_id',$governorateId)->value('price') ?? 0.0;
    }

    private function storeOrderItemFormCart(Order $order , Cart $cart){
        foreach ($cart->cartItems as $cartItem) {
            $order->orderItems()->create([
                'product_id'=>$cartItem->product_id,
                'product_variant_id'=>$cartItem->product_variant_id,
                'product_name'=>optional($cartItem->product)->name ?? 'unknown product',
                'product_desc'=>optional($cartItem->product)->small_desc ?? 'unknown',
                'product_quantity'=>$cartItem->quantity,
                'product_price'=>$cartItem->price,
                'attributes'=>json_encode($cartItem->attributes),
            ]);
        }
    }

    public function clearUserCart(Cart $cart){
        // $cart->cartItems->delete();
        $cart->cartItems()->delete();
        $cart->update(['coupon'=>null]);   
    }


}
