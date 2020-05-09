<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        if ($this->method() === 'PUT') {
            $rules = [
                'title' => 'string|min:10|max:50',
                'code' => 'numeric',
                'available' => 'string|min:8|max:15',
                'image.*' => 'image|mimes:jpeg,png,jpg',
                'quantity' => 'numeric|min:1|max:8',
                'original_price' => 'numeric|between:000000.000,999999.999',
                'sales_price' => 'numeric|between:000000.000,999999.999',
            ];
        } elseif ($this->method() === 'PATCH') {
            $rules = [
                'title' => 'string|min:10|max:50',
                'code' => 'numeric',
                'available' => 'string|min:8|max:15',
                'image.*' => 'image|mimes:jpeg,png,jpg',
                'quantity' => 'numeric|min:1|max:8',
                'original_price' => 'numeric|between:000000.000,999999.999',
                'sales_price' => 'numeric|between:000000.000,999999.999',
            ];
        } else {
            $rules = [
                'brand_id' => 'required',
                'category_id' => 'required',
                'sub_category_id' => 'required',
                'title' => 'required|string|min:10|max:50',
                'desc' => 'required',
                'code' => 'required|numeric',
                'available' => 'required|string|min:8|max:15',
                'image.*' => 'required|image|mimes:jpeg,png,jpg',
                'quantity' => 'required|numeric|min:1|max:8',
                'original_price' => 'required|numeric|between:000000.000,999999.999',
                'sales_price' => 'required|numeric|between:000000.000,999999.999',
                'offer_price' => 'between:000000.000,999999.999',
                'is_new' => 'required',

            ];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'brand_id.required' => 'Brand Name field must be Selected!',
            'category_id.required' => 'Category Name field must be Selected!',
            'sub_category_id.required' => 'Sub-Category Name field must be Selected!',
            'title.required' => 'Title name field must be filled out!',
            'desc.required' => 'Description field must be filled out!',
            'code.required' => 'Product Code field must be filled out!',
            'available.required' => 'Product Available field must be filled out!',
            'image.*.required' => 'Slider Image field must be filled out!',
            'quantity.required' => 'Product Quantity field must be filled out!',
            'original_price.required' => 'Product Original price field must be filled out!',
            'sales_price.required' => 'Product Sales price field must be filled out!',
            'offer_price.required' => 'Product Offer price field must be filled out!',
            'total_sales.required' => 'Product Total sales field must be filled out!',
            'is_new.required' => 'Product Is New field must be filled out!',
            'title.string' => 'Title name must be Alphabetic letter!',
            'available.string' => 'Product Available name must be Alphabetic letter!',
            'title.min:15' => 'Title name at-least 10 Character\'s!',
            'title.max:25' => 'Title name must be less than 50 Character\'s',
            'available.min:8' => 'Sub-Title name at-least 8 Character\'s!',
            'available.max:15' => 'Sub-Title name must be less than 15 Character\'s',
            'quantity.min:1' => 'Sub-Title name at-least 1 Character\'s!',
            'quantity.max:8' => 'Sub-Title name must be less than 8 Character\'s',
            'image.*.image' => 'Please upload an image',
            'image.*.mimes' => 'Only jpeg, jpg, png images are allowed',

        ];
    }

}
