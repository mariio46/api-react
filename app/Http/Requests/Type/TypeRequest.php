<?php

namespace App\Http\Requests\Type;

use App\Models\Type;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TypeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required', 'string', 'min:5', 'max:255', Rule::unique(Type::class)->ignore($this?->type, 'id'),
            ],
        ];
    }
}
