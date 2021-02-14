<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStorePostRequest extends FormRequest
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
            'photo_id'=>'required','photo_id.*' => 'image|mimes:jpeg,png,jpg,svg|max:4096',
            'title'=>'required|max:255|min:2',
            'body'=>'required|max:2000|min:2',
            'mobile_number'=>'required|numeric|min:9',
            'price'=>'required|numeric|min:0',
            'category_id' => 'required|integer',
            'city_id' => 'required|integer',
        ];
    }
    public function messages(){
        return [
            'photo_id.required'=>'Ju lutem ngarkoni një foto.',
            'photo_id.*.image'=>'Ju lutem ngarkoni një foto.',
            'photo_id.*.mimes'=>'Ju lutem ngarkoni foto të formatit: jpeg,png,jpg dhe svg.',
            'title.required'=>'Titulli duhet të plotësohet.',
            'title.max'=>'Titulli duhet te kete maksimum 255 karaktere.',
            'title.min'=>'Titulli duhet te kete minimum 2 karaktere.',
            'body.required'=>'Përshkrimi duhet të plotësohet.',
            'body.max'=>'Përshkrimi duhet të ketë maksimum 2000 karaktere.',
            'body.min'=>'Përshkrimi duhet të ketë minimum 2 karaktere.',
            'mobile_number.required'=>'Numri i telefonit duhet të plotësohet.',
            'mobile_number.numeric'=>'Numri i telefonit duhet të përmbajë numra.',
            'mobile_number.min'=>'Numri i telefonit duhet të ketë minimum 9 shifra.',
            'price.required'=>'Çmimi duhet të plotësohet.',
            'price.numeric'=>'Çmimi duhet të përmbajë numra.',
            'price.min'=>'Çmimi duhet të jetë më i madh se 0.',
            'category_id.required'=>'Kategoria duhet të plotësohet.',
            'category_id.integer'=>'Kategoria duhet të plotësohet.',
            'city_id.required'=>'Kategoria duhet të plotësohet.',
            'city_id.integer'=>'Kategoria duhet të plotësohet.',
        ];
    }
}
