<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'nullable|min:8',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'メールアドレスは必須です。',
            'email.required' => 'メールアドレスは必須です。',
            'email.email' => '正しいメールアドレスを入力してください。',
            'password.min' => 'パスワードは8文字以上で入力してください。',
        ];
    }
}
