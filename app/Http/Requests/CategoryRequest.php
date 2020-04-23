<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        if ($this->method() == 'PUT') {
            $rules = [
                'category_name' => 'string|min:15|max:25',
                'image' => 'image',
            ];
        } elseif ($this->method() == 'PATCH') {
            $rules = [
                'category_name' => 'string|min:15|max:25',
                'image' => 'image',
            ];
        } else {
            $rules = [
                'brand_id' => 'required',
                'category_name' => 'required|string|min:15|max:25',
                'image' => 'required|image',
            ];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'brand_id.required' => 'Must be select Brand name!',
            'category_name.required' => 'Category name field must be filled out!',
            'category_name.string' => 'Category name must be Small or Capital Alphabetic letter!',
            'category_name.min:15' => 'Category name at-least 15 Character\'s!',
            'category_name.max:25' => 'Category name must be less than 20 Character\'s',
            'image.required' => 'Category Image field must be filled out!',
            'image.image' => 'Category Image field must be an image file!',
        ];
    }
}
