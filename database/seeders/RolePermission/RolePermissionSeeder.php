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
        ]);

        $permissions->each(fn ($permission) => Permission::create(['name' => $permission]));

        Role::findByName(name: 'admin')->givePermissionTo([
            'update full account',
            'delete account',

            'management member',

            'management products',
        ]);

        Role::findByName(name: 'member')->givePermissionTo([
            'update half account',
        ]);
    }
}
