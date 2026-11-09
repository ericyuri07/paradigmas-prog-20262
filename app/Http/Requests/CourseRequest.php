<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|min:2|max:255',
            'description' => 'nullable|string|max:1000'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'name.string' => 'O campo nome deve conter caracteres.',
            'name.min' => 'O campo nome deve ter no mínimo :min caracteres.',
            'name.max' => 'O campo nome deve ter no máximo :max caracteres.',
            'description.string' => 'O campo descrição deve conter caracteres.',
            'description.max' => 'O campo descrição deve ter no máximo :max caracteres.'
        ];
    }
}