<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\Response;

class UserRepository
{
    public function all(): Collection
    {
        return User::all();
    }

    public function create(array $array)
    {
        $array['password'] = bcrypt($array['password']);
        User::create($array);
    }

    public function find($id)
    {
        $user = User::find($id);
        if (!$user) {
            abort(Response::HTTP_BAD_REQUEST);
        }
        return $user;
    }

    public function syncRoles(User $user, array $roles)
    {
        $user->syncRoles($roles);
    }

    public function update(User $user, array $validated)
    {
        if ($validated['password']) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);
    }

    public function delete(User $user)
    {
        $user->delete();
    }
}
