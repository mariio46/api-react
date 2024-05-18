<?php

namespace App\Http\Requests\RolePermission;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('management role permission') ? true : false;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required', 'string', 'min:3', Rule::unique(Role::class)->ignore($this->role),
            ],
            'permissions' => [
                'required', 'array',
            ],
            'permissions.*' => [
                Rule::exists(Permission::class, 'name'),
            ],
        ];
    }
}
