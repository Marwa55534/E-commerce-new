<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use CodeZero\UniqueTranslation\UniqueTranslationRule;

class AttributeRequest extends FormRequest
{
   protected $stopOnFirstFailure = true; // بيطلع اول ايرور فقط ف validat
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name.*'=>['required' , "string",'min:2' , 'max:60' ,  UniqueTranslationRule::for('attributes')->ignore($this->id)],
            'value.*.*'=>['required' , "string",'min:2' , 'max:60'],

        ];
    }
}
