<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserLoginRequest extends FormRequest
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
            'email' => 'required|email',
            'password' => 'required|string|min:6|max:25'
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Email alanı boş bırakılamaz',
            'email.email' => 'Email adresi geçerli bir email adresi olmalıdır',
            'password.required' => 'Şifre alanı boş bırakılamaz',
            'password.string' => 'Şifre alanı metin tipinde olmalıdır',
            'password.min' => 'Şifre en az 6 karakter olmalıdır',
            'password.max' => 'Şifre en fazla 25 karakter olmalıdır'
        ];
    }
}
