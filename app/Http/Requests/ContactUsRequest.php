<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactUsRequest extends FormRequest
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

        $rules = [
//            'to' => 'required',
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'phone' => 'required',
            'message' => 'required',
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'to.required' => 'Sender Mail field must be filled out!',
            'name.required' => 'Name field must be filled out!',
            'email.required' => 'Email field must be filled out!',
            'subject.required' => 'Subject field must be filled out!',
            'phone.required' => 'Phone field must be filled out!',
            'message.required' => 'Message field must be filled out!',
        ];
    }


}
