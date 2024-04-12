<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
            'main_categories_id' => 'nullable|integer|exists:main_categories,id',
            'name' => 'nullable|string|max:90',
            'slug' => 'nullable|string|max:90|unique:categories,slug',
            'description' => 'nullable|string',
            'title' => 'nullable|string',
            'image_id' => 'nullable|integer|exists:images,id'
        ];
    }


    public function messages(): array
    {
        return [
            'main_categories_id.integer' => 'Ana kategori kimliği bir tamsayı olmalıdır.',
            'main_categories_id.exists' => 'Belirtilen ana kategori kimliği geçerli değil.',
            'name.string' => 'Kategori adı bir metin olmalıdır.',
            'name.max' => 'Kategori adı en fazla 90 karakter olabilir.',
            'slug.string' => 'Kategori slug\'ı bir metin olmalıdır.',
            'slug.max' => 'Kategori slug\'ı en fazla 90 karakter olabilir.',
            'slug.unique' => 'Belirtilen kategori slug\'ı başka bir kategoriye aittir.',
            'description.string' => 'Kategori açıklaması bir metin olmalıdır.',
            'title.string' => 'Kategori başlığı bir metin olmalıdır.',
            'image_id.integer' => 'Resim kimliği bir tamsayı olmalıdır.',
            'image_id.exists' => 'Belirtilen resim kimliği geçerli değil.'
        ];
    }
}
