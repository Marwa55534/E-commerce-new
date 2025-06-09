<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Role;
use Spatie\Translatable\HasTranslations;

class Admin extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable ,HasTranslations;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "name" , "email" , "password" , "status" ,"role_id"
    ];
    public $translatable = [];


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

    public function role(){
        return $this->belongsTo(Role::class);
    }

      public function hasAccess($config_permession){ // lope all folder congig authorizations , users , admins , posts ....

        // محتاجه اجيب صلاحيات auth
        $role = $this->role;
        if(!$role){
            return false;
        }
        
        // هعمل foreach ع صلاحيات الادمن
        // authorizations 2 col -> role , permissions
        foreach($role->permession as $permession){
            if($config_permession == $permession ?? false){  
                return true;
            }
        }
    }

    public function getStatusAttribute($value){
        return $value == 1 ? 'Active' : 'Inactive' ;
    }

    public function receivesBroadcastNotificationsOn(): string
    {
        return 'admins.'. $this->id;
    }
}

