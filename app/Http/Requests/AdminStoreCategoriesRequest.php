<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminStoreCategoriesRequest extends FormRequest
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
            'name'=>'required|min:2|max:255'
        ];
    }
    public function messages(){
        return [
            'name.required'=>'Kategoria duhet të plotësohet.',
            'name.min'=>'Kategoria duhet të ketë minimum 2 karaktere.',
            'name.max'=>'Kategoria duhet të ketë maksimum 255 karaktere.',
        ];
    }
}
