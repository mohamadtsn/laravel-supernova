<?php

namespace App\Http\Requests\Panel\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Mohamadtsn\Supernova\Models\Role;
use Spatie\Permission\Guard;

class SetRoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'role' => [
                'nullable',
                'array',
                Rule::exists('roles', 'id')->where('guard_name', Guard::getDefaultName(Role::class))
            ],
        ];
    }
}
