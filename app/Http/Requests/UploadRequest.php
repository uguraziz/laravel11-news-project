<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadRequest extends FormRequest
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
            'file' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'name' => 'required|string|max:255'
        ];
    }

    public function messages(): array
    {
        return [
            'file.required' => 'File is required',
            'file.image' => 'File must be an image',
            'file.mimes' => 'File must be a file of type: jpeg, png, jpg',
            'file.max' => 'File must be less than 2MB',
            'name.required' => 'Name is required',
            'name.string' => 'Name must be a string',
            'name.max' => 'Name must be less than 255 characters'
        ];
    }
}
