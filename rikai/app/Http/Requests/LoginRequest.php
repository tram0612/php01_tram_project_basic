<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => 'required|email',
            'password' => 'min:8|max:20',
        ];
    }
    public function messages()
    {
        return [
                'email.required' => 'Vui lòng nhập email',
                'email.email' => 'Vui lòng nhạp email',
                'password.min' => 'Vui lòng nhập password ít nhất 8 kí tự và nhiều nhất 20',
                'password.max' => 'Vui lòng nhập password ít nhất 8 kí tự và nhiều nhất 20',
        ];
    }
}
