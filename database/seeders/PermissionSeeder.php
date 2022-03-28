<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public array $models = [
        'permissions',
        'roles',
        'users',
        'devices',
    ];

    public array $permissions = [
        'index',
        'store',
        'show',
        'update',
        'destroy',
    ];

    public array $extraPermissions = [
        'dashboard',
    ];

    public function run(): void
    {
        foreach ($this->models as $model) {
            foreach ($this->permissions as $permission) {
                Permission::updateOrCreate([
                    'name' => "$model.$permission"
                ], [
                    'guard_name' => 'web'
                ]);
            }
        }
        foreach ($this->extraPermissions as $extra_permission) {
            Permission::updateOrCreate([
                'name' => $extra_permission,
            ], [
                'guard_name' => 'web'
            ]);
        }
    }
}
