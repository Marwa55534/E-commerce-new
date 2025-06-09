<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use CodeZero\UniqueTranslation\UniqueTranslationRule;

class PageRequest extends FormRequest
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
    public function rules(): array
    {
        $rules = [
            "title.*"=>["required" , "string" , "max:150"],
            "content.*"=>["required" , "min:3" , "max:100000"],
        ];
        if ($this->method() == 'PUT') {
            $rules['image'] = ['nullable', 'image', "mimes:png,jpeg,jpg.gif,svg,webp","max:2048"];
        } else {
            $rules['image'] = ['required', 'image', "mimes:png,jpeg,jpg,gif,svg,webp","max:2048"];
        }
        return $rules;
    }
}
