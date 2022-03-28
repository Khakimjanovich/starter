<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Contracts\Role as RoleContract;
use Spatie\Permission\Models\Role;

class RoleRepository
{
    public function all(): Collection
    {
        return Role::all();
    }

    public function create(array $array): Role|Model
    {
        return Role::create($array);
    }

    public function findById(int $id): RoleContract
    {
        return Role::findById($id);
    }

    public function update(Role $role, array $array): bool
    {
        return $role->update($array);
    }

    public function syncPermissions(Role $role, array $permissions): Role
    {
        return $role->syncPermissions($permissions);
    }

    public function delete(Role $role): ?bool
    {
        return $role->delete();
    }
}
