<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Country;
use App\Models\Governorate;
use Spatie\Translatable\HasTranslations;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable ;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    // public $translatable = ['name'];

    protected $fillable = [
        'name',
        'email',
        'password',
        'mobile',
        'status',
        'image',
        "email_verified_at",
        'country_id',
        'governorate_id',
        'city_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getStatusTranslated()
    {
        return $this->status == 1 ? __('dashboard.active') : __('dashboard.inactive');
    }

    public function getImageAttribute($image){
        return 'uploads/users/' . $image;
    } 
    // relation
    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function governorate(){
        return $this->belongsTo(Governorate::class);
    }

    public function  city()
    {
        return $this->belongsTo(City::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function cart()
{
    return $this->hasOne(Cart::class);
}

  

      // accessors
      public function getCreatedAtAttribute($value)
      {
          return date('d/m/Y H:i a', strtotime($value));
      }
      public function getEmailVerifiedAtAttribute($value)
      {
          return date('d/m/Y H:i a', strtotime($value));
      }
}
