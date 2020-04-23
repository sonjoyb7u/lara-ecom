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
        if ($this->method() == 'PUT') {
            $rules = [
                'sub_category_name' => 'max:25',
            ];
        } elseif ($this->method() == 'PATCH') {
            $rules = [
                'sub_category_name' => 'max:25',
            ];
        } else {
            $rules = [
                'brand_id' => 'required',
                'category_id' => 'required',
                'sub_category_name' => 'required|max:25',
            ];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'brand_id.required' => 'Must be select Brand name!',
            'category_id.required' => 'Must be select Category name!',
            'sub_category_name.required' => 'Sub-Category name field must be filled out!',
            'sub_category_name.max:25' => 'Sub-Category name must be less than 20 Character\'s',
        ];
    }

}
