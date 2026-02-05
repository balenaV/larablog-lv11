<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    /**
     * Prepara os dados antes de passarem pela regra de validação.
     */
    protected function prepareForValidation()
    {
        $loginId = $this->input('login_id');

        $this->merge([
            'login_type' => filter_var($loginId, FILTER_VALIDATE_EMAIL) ? 'email' : 'username'
        ]); // Identifica se é email ou username e adiciona este input no request, já com o valor filtrado
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'password' => 'required|min:5',
            'login_id' => $this->login_type === 'email'
                ? 'required|email|exists:users,email'
                : 'required|exists:users,username'
        ];
    }

    public function messages(): array
    {
        $isEmail = $this->login_type === 'email';

        return [
            'login_id.required' => 'Enter your email or username',
            'login_id.email'    => 'Invalid email address',
            'login_id.exists'   => $isEmail
                ? 'No account found for this email'
                : 'No account found for this username',
        ];
    }
}
