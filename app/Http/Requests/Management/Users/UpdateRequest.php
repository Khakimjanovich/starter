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
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($this->id)],
            'password' => 'sometimes|confirmed',
            'roles' => 'sometimes|array',
            'roles.*' => 'sometimes|exists:roles,name',
        ];
    }
}
