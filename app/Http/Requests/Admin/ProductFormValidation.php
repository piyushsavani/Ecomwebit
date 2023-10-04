<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductFormValidation extends FormRequest
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
            'category_id'=> ['required','integer'],
            'selling_price'=> ['required','integer'],
            'qauntity'=> ['required','integer'],
            'product_name'=> ['required','string'],
            'product_slug'=> ['required','string'],
            'brand'=> ['required','string'],
            'description'=> ['required'],
            'image'=> ['nullable'],
            'meta_description'=> ['nullable'],
            'meta_title'=> ['nullable'],
            'meta_keyword'=> ['nullable'],                 
        ];
    }
}
