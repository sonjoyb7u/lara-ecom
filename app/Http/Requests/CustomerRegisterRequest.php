<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRegisterRequest extends FormRequest
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
                'name' => 'required|min:3|max:30',
                'email' => 'required|unique:customers, email',
                'phone' => 'required|min:11|max:11',
                'password' => 'required|min:6|max:25|required_with:password_confirmation|same:password_confirmation',
            ];
        } elseif ($this->method() === 'PATCH') {
            $rules = [
                'name' => 'required|min:3|max:30',
                'email' => 'required|unique:customers, email',
                'phone' => 'required|min:11|max:11',
                'password' => 'required|min:6|max:25|required_with:password_confirmation|same:password_confirmation',
            ];

        } else {
            $rules = [
                'name' => 'required|min:3|max:30',
                'email' => 'required|unique:customers, email',
                'phone' => 'required|min:11|max:11',
                'password' => 'required|min:6|max:25|required_with:password_confirmation|same:password_confirmation',
//                'address' => 'required|max:255',

            ];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'Name field must be filled out!',
            'email.required' => 'Email field must be filled out!',
            'phone.required' => 'Mobile Number field must be filled out!',
            'password.required' => 'Password field must be filled out!',
//            'address.required' => 'Address field must be filled out!',
            'password_confirmation.required' => 'Password Confirmation field must be filled out!',
            'email.unique' => 'Email has already been taken!',
            'phone.min:11' => 'Mobile Number must be minimum 11 digit\'s',
            'phone.max:11' => 'Mobile Number must be less than 11 digit\'s',
            'password.min:6' => 'Mobile Number must be 6 Character\'s',
            'password.max:25' => 'Mobile Number must be less than 26 Character\'s',
            'password.same' => 'Password & Confirm Password does not matched!',
//            'address.max:255' => 'Address text must be less than 256 Character\'s',

        ];
    }

}
