<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
            // 'name' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Yêu cầu điền email.',
            'email.email' => 'Email không hợp lệ.',
            'email.exists' => 'Email này chưa được đăng ký.',
            'password.required' => 'Yêu cầu điền mật khẩu.',
            // 'name.required' => 'Yêu cầu điền họ tên.',
        ];
    }
}
