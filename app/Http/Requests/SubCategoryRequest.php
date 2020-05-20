<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubCategoryRequest extends FormRequest
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
                'sub_category_name' => 'max:60',
                'banner' => 'image|mimes:jpeg,png,jpg',
            ];
        } elseif ($this->method() === 'PATCH') {
            $rules = [
                'sub_category_name' => 'max:60',
                'banner' => 'image|mimes:jpeg,png,jpg',
            ];
        } else {
            $rules = [
                'category_id' => 'required',
                'sub_category_name' => 'required|max:60',
                'banner' => 'required|image|mimes:jpeg,png,jpg',
            ];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'category_id.required' => 'Must be select Category name!',
            'sub_category_name.required' => 'Sub Category name field must be filled out!',
            'sub_category_name.max:60' => 'Sub Category name must be less than 60 Character\'s',
            'banner.required' => 'Sub Category Banner field must be filled out!',
            'banner.image' => 'Sub Category Banner field must be an image file!',
            'banner.mimes' => 'Only jpeg, jpg, png images are allowed',
        ];
    }

}
