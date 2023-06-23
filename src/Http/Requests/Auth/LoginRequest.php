<?php

namespace App\Http\Requests\Panel\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return ([
                'username' => 'required|email',
                'password' => 'required|string|min:8',
            ] + $this->recaptchaRules());
    }

    private function recaptchaRules(): array
    {
        if (config('supernova.recaptcha_login')) {
            return [
                recaptchaFieldName() => ['required', recaptchaRuleName()]
            ];
        }
        return [];
    }
}
