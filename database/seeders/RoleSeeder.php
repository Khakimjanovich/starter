<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    private array $roles = [
        [
            'name' => 'SuperAdmin',
            'guard_name' => 'web',
        ],
        [
            'name' => 'user',
            'guard_name' => 'web',
        ],
    ];

    public function run(): void
    {
        foreach ($this->roles as $role) {
            Role::firstOrCreate($role, ['guard_name' => 'web']);
        }

        $role = Role::whereName('SuperAdmin')->first();
        $role->syncPermissions(Permission::select('name')->get()->pluck('name'));
    }
}
