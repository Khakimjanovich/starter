<?php

namespace App\Http\Requests\Management\Users;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'roles' => 'sometimes|array',
            'roles.*' => 'sometimes|exists:roles,name',
        ];
    }
}
