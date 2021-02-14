<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreCommentRepliesRequest extends FormRequest
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
            'body'=>'required|max:255|min:2'
        ];
    }
    public function messages(){
        return [
            'body.required'=>'Komenti duhet të plotësohet.',
            'body.min'=>'Komenti duhet të ketë minimum 2 karaktere.',
            'body.max'=>'Komenti duhet të ketë maksimum 255 karaktere.',
        ];
    }
}
