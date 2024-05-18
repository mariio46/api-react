<?php

namespace App\Http\Requests\RolePermission;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;

class PermissionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('management role permission') ? true : false;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required', 'string', 'min:5', Rule::unique(Permission::class)->ignore($this->permission),
            ],
        ];
    }
}
