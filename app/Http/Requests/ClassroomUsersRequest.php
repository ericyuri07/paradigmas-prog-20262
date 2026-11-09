<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassroomUsersRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'action' => 'required|in:attach,detach',
            'user_ids' => 'required|array|min:1',
            'user_ids.*' => 'integer|exists:users,id'
        ];
    }

    public function messages()
    {
        return [
            'action.required' => 'O campo ação é obrigatório.',
            'action.in' => 'A ação deve ser attach (incluir) ou detach (remover).',
            'user_ids.required' => 'Informe ao menos um usuário.',
            'user_ids.array' => 'O campo usuários deve ser uma lista de IDs.',
            'user_ids.min' => 'Informe ao menos um usuário.',
            'user_ids.*.integer' => 'Cada usuário deve ser informado pelo ID.',
            'user_ids.*.exists' => 'Um dos usuários informados não existe.'
        ];
    }
}