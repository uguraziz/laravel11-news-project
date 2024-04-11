<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
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
            'main_categories_id' => 'required|integer|exists:main_categories,id',
            'name' => 'required|string|max:90',
            'slug' => 'required|string|max:90|unique:categories,slug',
            'description' => 'nullable|string',
            'title' => 'nullable|string',
            'image_id' => 'nullable|integer|exists:images,id'
        ];
    }

    public function messages(): array
    {
        return [
            'main_categories_id.required' => 'Ana kategori kimliği gereklidir.',
            'main_categories_id.integer' => 'Ana kategori kimliği bir tamsayı olmalıdır.',
            'main_categories_id.exists' => 'Belirtilen ana kategori kimliği geçerli değil.',
            'name.required' => 'İsim alanı gereklidir.',
            'name.string' => 'İsim alanı bir metin olmalıdır.',
            'name.max' => 'İsim alanı en fazla 90 karakter olmalıdır.',
            'slug.required' => 'Slug alanı gereklidir.',
            'slug.string' => 'Slug alanı bir metin olmalıdır.',
            'slug.max' => 'Slug alanı en fazla 90 karakter olmalıdır.',
            'slug.unique' => 'Belirtilen slug daha önce kullanılmış.',
            'description.string' => 'Açıklama alanı bir metin olmalıdır.',
            'title.string' => 'Başlık alanı bir metin olmalıdır.',
            'image_id.integer' => 'Resim kimliği bir tamsayı olmalıdır.',
            'image_id.exists' => 'Belirtilen resim kimliği geçerli değil.',
        ];
    }
}
