<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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
                'message' => 'string|min:10|max:30',
                'title' => 'string|min:20|max:50',
                'sub_title' => 'string|min:50|max:150',
                'image' => 'image',
                'start' => 'required',
                'end' => 'required',
                'url' => 'required',
            ];
        } elseif ($this->method() == 'PATCH') {
            $rules = [
                'message' => 'string|min:10|max:30',
                'title' => 'string|min:20|max:50',
                'sub_title' => 'string|min:50|max:150',
                'image' => 'image',
                'start' => 'required',
                'end' => 'required',
                'url' => 'required',
            ];
        } else {
            $rules = [
                'message' => 'required|string|min:10|max:30',
                'title' => 'required|string|min:20|max:50',
                'sub_title' => 'required|string|min:50|max:150',
                'image' => 'required|image',
                'start' => 'required',
                'end' => 'required',
                'url' => 'required',

            ];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'message.required' => 'Message name field must be filled out!',
            'message.string' => 'Category name must be Small or Capital Alphabetic letter!',
            'message.min:15' => 'Category name at-least 10 Character\'s!',
            'message.max:25' => 'Category name must be less than 30 Character\'s',
            'title.required' => 'Title name field must be filled out!',
            'title.string' => 'Title name must be Small or Capital Alphabetic letter!',
            'title.min:15' => 'Title name at-least 10 Character\'s!',
            'title.max:25' => 'Title name must be less than 20 Character\'s',
            'sub_title.required' => 'Sub-Title name field must be filled out!',
            'sub_title.string' => 'Sub-Title name must be Small or Capital Alphabetic letter!',
            'sub_title.min:15' => 'Sub-Title name at-least 10 Character\'s!',
            'sub_title.max:150' => 'Sub-Title name must be less than 150 Character\'s',
            'image.required' => 'Slider Image field must be filled out!',
            'image.image' => 'Slider Image field must be an image file!',
            'start.required' => 'Date time field must be filled out!',
            'end.required' => 'Date time field must be filled out!',
            'url.required' => 'URL name field must be filled out!',
        ];
    }
}
