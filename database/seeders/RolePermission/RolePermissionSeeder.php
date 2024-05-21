<?php

namespace Database\Seeders\RolePermission;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Create Roles
        collect(['superadmin', 'admin', 'member'])->each(fn ($role) => Role::create(['name' => $role]));

        // Create Permissions
        $permissions = collect([
            // For Menu Settings
            'update full account',
            'update half account',
            'delete account',

            // For Menu Role Permission
            'management role permission',

            // For Menu Users
            'management admin',
            'management member',

            // For Menu Product
            'management products',

            // For Menu Category
            'management categories',

            // For Menu Type
            'management types',
        ]);

        $permissions->each(fn ($permission) => Permission::create(['name' => $permission]));

        Role::findByName(name: 'admin')->givePermissionTo([
            'update full account',
            'delete account',

            'management member',

            'management products',
            'management categories',
            'management types',
        ]);

        Role::findByName(name: 'member')->givePermissionTo([
            'update half account',
        ]);
    }
}
