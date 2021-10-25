<?php

namespace App\Http\Requests\Management\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => [
                'email',
                'required',
                Rule::unique('users', 'email')->ignore((int)($this->request->get('id')))
            ],
            'password' => 'sometimes|confirmed',
            'roles' => 'sometimes|array',
            'roles.*' => 'required|exists:roles,name'
        ];
    }
}
