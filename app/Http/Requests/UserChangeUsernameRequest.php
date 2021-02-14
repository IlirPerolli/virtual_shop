<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserChangeUsernameRequest extends FormRequest
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
            'username' => ['required', 'string','min:3', 'max:255','regex:/^[A-Za-z0-9]+$/', 'unique:users']
        ];
    }
    public function messages(){
        return [
            'username.required'=>'Username duhet të plotesohet.',
            'username.max'=>'Username duhet të ketë maksimum 255 karaktere.',
            'username.min'=>'Username duhet të ketë minimum 3 karaktere.',
            'username.string'=>'Username duhet të jetë me shkronja.',
            'username.regex'=>'Username duhet të përmbajë shkronja A-Z dhe numra 0-9.',

        ];
    }
}
