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
          'name.required'=>'Emri duhet të plotesohet.',
            'name.max'=>'Emri duhet të ketë maksimum 255 karaktere.',
            'name.min'=>'Emri duhet të ketë minimum 2 karaktere.',
            'surname.required'=>'Mbiemri duhet të plotësohet.',
            'surname.max'=>'Mbiemri duhet të ketë maksimum 255 karaktere.',
            'surname.min'=>'Mbiemri duhet të ketë minimum 2 karaktere.',
            'email.required'=>'Emaili duhet të plotesohet.',
            'email.max'=>'Emaili duhet të ketë maksimum 255 karaktere.',
            'email.min'=>'Emaili duhet të ketë minimum 5 karaktere.',
            'email.unique'=>'Ky email është në përdorim.',
            'bio.max'=>'Bio duhet të ketë maksimum 255 karaktere.'
        ];
    }
}
