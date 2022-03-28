<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Contracts\Permission as PermissionContract;
use Spatie\Permission\Models\Permission;

class PermissionRepository
{
    public function all(): Collection
    {
        return Permission::all();
    }

    public function create(array $array): Permission|Model
    {
        return Permission::create($array);
    }

    public function findById(int $id): PermissionContract
    {
        return Permission::findById($id);
    }

    public function update(Permission $permission, array $array): bool
    {
        return $permission->update($array);
    }

    public function delete(Permission $permission): ?bool
    {
        return $permission->delete();
    }
}
