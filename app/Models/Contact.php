<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'replay_status',
        'is_read',
        'is_starred',
        'user_id', 
        'is_spam',
    ];

    // relation
    public function user(){
        return $this->belongsTo(User::class);
    }

    // search
    public static function searchContact($keyword)
    {
        return self::when($keyword, function($query) use($keyword){
            $query->Where('email','like','%'.$keyword.'%');
        });
    }

    // scope
    // Scopes
    public function scopeRead($query)
    {
        return $query->where('is_read',1);
    }
    public function scopeUnread($query)
    {
        return $query->where('is_read',0);
    }
    public function scopeAnswered($query)
    {
        return $query->where('replay_status',1);
    }
    public function scopeUnanswered($query)
    {
        return $query->where('replay_status',0);
    }
    public function scopeStarred($query)
    {
        return $query->where('is_starred',1); 
    }
    public function scopeUnstarred($query)
    {
        return $query->where('is_starred',0);
    }

    public function scopeSpam($query)
    {
        return $query->where('is_spam',1); 
    }
    public function scopeUnspam($query)
    {
        return $query->where('is_spam',0);
    }

    // accessor for created at and updated at
    public function getUpdatedAtAttribute($value)
    {
        return date('d-m-Y H:i:s a', strtotime($value));
    }
}
