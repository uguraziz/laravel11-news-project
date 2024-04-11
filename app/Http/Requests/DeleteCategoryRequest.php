<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeleteCategoryRequest extends FormRequest
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
            'id' => 'required|integer|exists:categories,id'
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'Kategori kimliği gereklidir.',
            'id.integer' => 'Kategori kimliği bir tamsayı olmalıdır.',
            'id.exists' => 'Belirtilen kategori kimliği geçerli değil.'
        ];
    }
}
