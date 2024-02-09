<?php

namespace App\Http\Requests\Users;

use App\Models\User;
use App\Models\Permissions\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserCreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'min:8'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'password' => ['required', 'string', 'max:255', 'min:8', 'regex:/^(?=.*[A-Z])(?=.*[!@#$&*]).+$/'],
            'role' => ['required', 'numeric', 'exists:roles,id'],
        ];
    }
}
