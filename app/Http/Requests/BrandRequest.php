<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use CodeZero\UniqueTranslation\UniqueTranslationRule;

class BrandRequest extends FormRequest
{
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
    public function rules()
    {
        $rules = [
            "name.*"=>["required" , "string" , "max:150" , UniqueTranslationRule::for('brands')->ignore($this->id)],
            'status'=>['required','in:1,0,off,on'],
            // 'logo'=>['nullable','image' ,"mimes:png,jpeg,jpg"],
        ];

        // Conditionally add 'logo' validation rules based on the request method
        if ($this->method() == 'PUT') {
            $rules['logo'] = ['nullable', 'image', "mimes:png,jpeg,jpg"];
        } else {
            $rules['logo'] = ['required', 'image', "mimes:png,jpeg,jpg"];
        }
        return $rules;

    }
}
