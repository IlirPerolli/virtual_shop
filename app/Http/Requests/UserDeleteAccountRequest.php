<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserDeleteAccountRequest extends FormRequest
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
            'current_password'=>'required|max:255|min:8'
        ];
    }
    public function messages(){
        return [
            'current_password.required'=>'Fjalëkalimi duhet të plotesohet.',
            'current_password.max'=>'Fjalëkalimi duhet të ketë maksimum 255 karaktere.',
            'current_password.min'=>'Fjalëkalimi duhet te kete minimum 8 karaktere.'
        ];
    }
}
