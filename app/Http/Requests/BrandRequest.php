<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
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
        if($this->method() == 'PUT') {
            $rules = [
                'brand_name' => 'required|unique:brands|max:25',
                'brand_slug' => 'unique:brands',
            ];

        } elseif($this->method() == 'PATCH') {
            $rules = [
                'brand_name' => 'required|unique:brands|max:25',
                'brand_slug' => 'unique:brands',
            ];

        }else {
            $rules = [
                'brand_name' => 'required|unique:brands|max:25',
                'brand_slug' => 'unique:brands',
            ];

        }
        
        return $rules; 
    }

    public function messages() {

        return [
            'brand_name.required' => 'Brand name field must be filled out!',
            'brand_name.unique' => 'Brand Name has already been taken!',
            'brand_name.max:25' => 'Brand name must be less than 20 Character\'s',
            'brand_slug.unique' => 'Brand Slug has already been taken!',

        ];
    }
}
