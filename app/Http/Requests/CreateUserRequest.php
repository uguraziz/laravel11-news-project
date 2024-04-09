<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'name' => 'required|min:3|max:255|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|max:25'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Ad alanı boş bırakılamaz',
            'name.min' => 'Ad en az 3 karakter olmalıdır',
            'name.max' => 'Ad en fazla 255 karakter olmalıdır',
            'name.string' => 'Ad alanı metin tipinde olmalıdır',
            'email.required' => 'Email alanı boş bırakılamaz',
            'email.email' => 'Email adresi geçerli bir email adresi olmalıdır',
            'email.unique' => 'Bu email adresi zaten kullanılmaktadır',
            'password.required' => 'Şifre alanı boş bırakılamaz',
            'password.min' => 'Şifre en az 6 karakter olmalıdır',
            'password.max' => 'Şifre en fazla 20 karakter olmalıdır'
        ];
    }
}
