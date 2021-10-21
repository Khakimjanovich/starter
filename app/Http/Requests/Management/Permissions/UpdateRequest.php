<?php

namespace App\Http\Requests\Management\Permissions;

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
            'name' => [
                'required',
                Rule::unique('permissions', 'name')->ignore((int)$this->get('id'))
            ]
        ];
    }
}
