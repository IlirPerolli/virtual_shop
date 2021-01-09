<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserEditRequest extends FormRequest
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
            'name'=>'required|max:255|min:2',
            'surname'=>'required|max:255|min:2',
            'email' => 'required|max:255|min:5|unique:users,email,' . auth()->user()->id,
            'bio' => 'max:255',
        ];
    }
    public function messages(){
        return [
          'name.required'=>'Emri duhet te plotesohet',
            'name.max'=>'Emri duhet te kete maksimum 255 karaktere',
            'name.min'=>'Emri duhet te kete minimum 2 karaktere',
            'surname.required'=>'Mbiemri duhet te plotesohet',
            'surname.max'=>'Mbiemri duhet te kete maksimum 255 karaktere',
            'surname.min'=>'Mbiemri duhet te kete minimum 2 karaktere',
            'email.required'=>'Emaili duhet te plotesohet',
            'email.max'=>'Emaili duhet te kete maksimum 255 karaktere',
            'email.min'=>'Emaili duhet te kete minimum 5 karaktere',
            'email.unique'=>'Ky email eshte ne perdorim',
            'bio.max'=>'Bio duhet te kete maksimum 255 karaktere'
        ];
    }
}
