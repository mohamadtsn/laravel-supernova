<?php

namespace App\Http\Requests\Panel\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'username'  =>  'required|email',
            'password'  =>  'required|string|min:8',
        ] + $this->recaptchaRules();
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
