<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = User::query()->where('username', $this->user)->firstOrFail()->id;

        return [
            'name' => [
                'required', 'string', 'min:5', 'max:255',
            ],
            'email' => [
                'required', 'string', 'lowercase', 'email', Rule::unique(User::class)->ignore($id),
            ],
            'username' => [
                'required', 'string', 'lowercase', 'min:5', 'max:25',  Password::min(5)->letters()->numbers()->symbols(), Rule::unique(User::class)->ignore($id),
            ],
        ];
    }
}
