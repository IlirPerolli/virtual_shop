<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserChangePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'current_password'     => 'required',
            'password'     => 'required|min:8',
            'password_confirmation' => 'required|same:password',
        ];
    }
    public function messages(){
        return [
            'current_password.required'=>'Ju lutem shënoni fjalëkalimin aktual.',
            'password.required'=>'Ju lutem shënoni fjalëkalimin e ri.',
            'password.min'=>'Fjalëkalimi i ri duhet të jetë së paku 8 karaktere i gjatë.',
            'password_confirmation'=>'Ju lutem ri-shënoni fjalëkalimin e ri.',

        ];
    }
}
