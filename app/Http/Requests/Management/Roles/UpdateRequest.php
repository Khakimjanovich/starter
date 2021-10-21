<?php

namespace App\Http\Requests\Management\Roles;

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
            'id' => 'required|exists:roles,id',
            'name' => [
                'required',
                Rule::unique('roles', 'name')->ignore((int)$this->get('id')),
            ],
            'permissions' => 'sometimes|array',
            'permissions.*' => 'required|exists:permissions,name'
        ];
    }
}
