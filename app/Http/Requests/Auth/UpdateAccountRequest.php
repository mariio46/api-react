<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UpdateAccountRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required', 'string', 'min:3', 'max:255',
            ],
            'username' => [
                'required', 'string', 'lowercase', 'min:5', 'max:25',  Password::min(5)->letters()->numbers()->symbols(), Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'email' => [
                'required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id),
            ],
        ];
    }
}
