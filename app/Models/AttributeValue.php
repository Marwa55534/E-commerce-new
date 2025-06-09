<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use App\Models\Attribute;

class AttributeValue extends Model
{
    use HasTranslations;

    protected $table = 'attribute_values';
    public $timestamps = false;
    public $translatable = ['value'];
    protected $fillable = [
        "value", "attribute_id",
    ];

    // relation
    public function attribute(){
        return $this->belongsTo(Attribute::class);
    }
}
