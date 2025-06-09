<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'mobile' => 'required|string|max:15', 
            'password' => 'required|min:8|max:30',
            'country_id' => 'required|exists:countries,id', // selected
            'governorate_id' => 'required|exists:governorates,id', // selected
            'city_id' => 'required|exists:cities,id', // selected
            'status' => 'required|in:0,1', // radio
            'image' => ['required', 'image', "mimes:png,jpeg,jpg"],
        ];
    }
}
