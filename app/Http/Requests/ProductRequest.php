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
                'category_id' => 'required',
                'title' => 'required|string|min:10|max:50',
                'desc' => 'required',
                'product_code' => 'required',
                'product_model' => 'required',
                'product_color' => 'required',
                'product_size' => 'required',
                'image.*' => 'required|image|mimes:jpeg,png,jpg',
                'gallery.*' => 'required|image|mimes:jpeg,png,jpg',
//                'product_video_url' => '',
                'quantity' => 'required|numeric|min:1|max:8',
//                'warranty' => '',
                'original_price' => 'required|numeric|between:0000000.000,9999999.999',
                'sales_price' => 'required|numeric|between:0000000.000,9999999.999',
                'special_price' => 'between:0000000.000,9999999.999',
                'offer_price' => 'between:0000000.000,9999999.999',
                'available' => 'required|string|min:8|max:15',
            ];
        } elseif ($this->method() === 'PATCH') {
            $rules = [
                'category_id' => 'required',
                'title' => 'required|string|min:10|max:50',
                'desc' => 'required',
                'product_code' => 'required',
                'product_model' => 'required',
                'product_color' => 'required',
                'product_size' => 'required',
                'image.*' => 'required|image|mimes:jpeg,png,jpg',
                'gallery.*' => 'required|image|mimes:jpeg,png,jpg',
//                'product_video_url' => '',
                'quantity' => 'required|numeric|min:1|max:8',
//                'warranty' => '',
                'original_price' => 'required|numeric|between:0000000.000,9999999.999',
                'sales_price' => 'required|numeric|between:0000000.000,9999999.999',
                'special_price' => 'between:0000000.000,9999999.999',
                'available' => 'required|string|min:8|max:15',
            ];
        } else {
            $rules = [
                'category_id' => 'required',
                'title' => 'required|string|min:10|max:50',
                'desc' => 'required',
                'product_code' => 'required',
                'product_model' => 'required',
                'product_color' => 'required',
                'product_size' => 'required',
                'image.*' => 'required|image|mimes:jpeg,png,jpg',
                'gallery.*' => 'required|image|mimes:jpeg,png,jpg',
//                'product_video_url' => '',
                'quantity' => 'required|numeric|min:1|max:8',
//                'warranty' => '',
                'original_price' => 'required|numeric|between:0000000.000,9999999.999',
                'sales_price' => 'required|numeric|between:0000000.000,9999999.999',
//                'special_price' => 'numeric|between:000000.000,999999.999',
//                'offer_price' => 'numeric|between:000000.000,999999.999',
                'available' => 'required|string|min:8|max:15',

            ];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'category_id.required' => 'Category Name field must be Selected!',
            'title.required' => 'Title name field must be filled out!',
            'desc.required' => 'Description field must be filled out!',
            'product_code.required' => 'Product Code field must be filled out!',
            'product_model.required' => 'Product Model field must be filled out!',
            'product_color.required' => 'Product Color field must be filled out!',
            'product_size.required' => 'Product Size field must be filled out!',
            'image.*.required' => 'Product Image field must be filled out!',
            'gallery.*.required' => 'Product Gallery Image field must be filled out!',
            'quantity.required' => 'Product Quantity field must be filled out!',
            'original_price.required' => 'Product Original price field must be filled out!',
            'sales_price.required' => 'Product Sales price field must be filled out!',
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
            'gallery.*.image' => 'Please upload an Gallery image',
            'gallery.*.mimes' => 'Only jpeg, jpg, png Gallery images are allowed',
            'original_price.numeric' => 'Product Original price must be a number!',
            'sales_price.numeric' => 'Product Sales price must be a number!',
//            'special_price.numeric' => 'Product Special price must be a number!',
//            'offer_price.numeric' => 'Product Offer price must be a number!',
            'available.required' => 'Product Available field must be filled out!',

        ];
    }

}
