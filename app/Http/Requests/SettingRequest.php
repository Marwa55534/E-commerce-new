<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'site_name.*'=>['required','string','max:255'],
            'site_desc.*'=>['required','string','max:255'],
            'address.*'=>['required','string','max:255'],
            'meta_description.*'=>['required','string','min:60','max:160'],

            'phone*'=>['required','string','max:20'],
            'email'=>['required','email','string','max:255'],
            'email_support'=>['required','email','string','max:255'],

            'facebook'=>['required','url','max:255'],
            'youtupe'=>['required','url','max:255'],
            'twitter'=>['required','url','max:255'],
            'promotion_video_url'=>['required','url','max:255'],

            'logo'=>['nullable','max:255','mimes:jpeg,jpg,png,gif,bmp,webp,svg,ico,tiff' ],
            'favicon'=>['nullable','max:255','mimes:jpeg,jpg,png,gif,bmp,webp,svg,ico,tiff'],
            'site_copyright'=>['required','string','max:255'],
        ];
    }
}
