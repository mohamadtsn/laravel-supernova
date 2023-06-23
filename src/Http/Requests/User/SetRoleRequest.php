<?php

namespace App\Http\Requests\Panel\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Mohamadtsn\Supernova\Models\Role;
use Spatie\Permission\Guard;

class SetRoleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'role' => [
                'nullable',
                'array',
                Rule::exists('roles', 'id')->where('guard_name', Guard::getDefaultName(Role::class)),
            ],
        ];
    }
}
