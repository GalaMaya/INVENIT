<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            'view assets',
            'create assets',
            'edit assets',
            'delete assets',
            'assign assets',
            'view reports',
            'manage users',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles and assign permissions
        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo(Permission::all());

        $staff = Role::create(['name' => 'staff']);
        $staff->givePermissionTo([
            'view assets',
            'create assets',
            'edit assets',
            'assign assets',
        ]);

        $viewer = Role::create(['name' => 'viewer']);
        $viewer->givePermissionTo(['view assets']);
    }
}