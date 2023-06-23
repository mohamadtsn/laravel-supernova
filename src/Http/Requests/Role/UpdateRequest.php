<?php

namespace App\Http\Requests\Panel\Role;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id',
        ];
    }
}
