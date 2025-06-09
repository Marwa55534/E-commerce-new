<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Support\Facades\Config;
use Cviebrock\EloquentSluggable\Sluggable;

class Product extends Model
{
    use Sluggable ;
    use HasTranslations , HasFactory;
    protected $fillable = [
        "name" , "small_desc" , "desc" , "status" ,
        "sku" , "available_for" , "views","has_variants","price" , "has_discount","discount" , 
        "start_discount" , "end_discount" , "manage_stock" , "quantity" , "available_in_stock" ,
        "category_id" , "brand_id",
    ]; 
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    protected $translatable = ['name','desc','small_desc'];

    // علاقات
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function images(){
        return $this->hasMany(ProductImage::class); 
    }

    public function productPreviews(){
        return $this->hasMany(ProductPreviews::class);
    }
    public function tags(){
        return $this->belongsToMany(Tag::class ,'product_tags','product_id' , 'tag_id');
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function cartItems(){
        return $this->hasMany(CartItem::class);
    }

    public function isSimple()
    {
        return !$this->has_variants;
    }

    // accas
    public function getStatusTranslated()
    {
        if(Config::get('app.locale') == 'ar'){
            return $this->status == 1 ? 'مفعل' : 'غير مفعل';
        }else{
            return $this->status == 1 ? 'Active' : 'Inactive';
        }
    }
    public function hasVariantsTranslated()
    {
        if(Config::get('app.locale') == 'ar'){ // check local ar , en
            return $this->has_variants == 1 ? 'يوجد متغيرات' : 'لا يوجد متغيرات';
        }else{
            return $this->has_variants == 1 ? 'Yes Variants' : 'No Variants';
        }
    }
    // accessores

    public function getCreatedAtAttribute($value)
    {
        return date('d/m/Y H:i a', strtotime($value));
    }

    public function getUpdatedAtAttribute($value)
    {
        return date('d/m/Y H:i a', strtotime($value));
    }

    public function priceAttribute()
    {
        return $this->has_variants == 0 ? number_format($this->price, 2) : __("dashboard.has_variants");
    }
    public function quantityAttribute()
    {
        return $this->has_variants == 0 ? $this->quantity : __("dashboard.has_variants");
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status' , 1);
    }
    public function scopeInactive($query)
    {
        return $query->where('status' , 0);
    }

    public function getPriceAfterDiscount(){
        
        if($this->has_discount){
            return $this->price - $this->discount;
        }
        return $this->price;
    }

    public function discountPercentege(){
        if($this->variants()->exists() || !$this->discount || $this->price == 0){
            return '🔥';
        }

        return round(($this->discount / $this->price) * 100,2).'%';
    }

    protected $casts = [
        'manage_stock' => 'boolean',
        'quantity' => 'integer',
        'price' => 'float',
    ];
}
