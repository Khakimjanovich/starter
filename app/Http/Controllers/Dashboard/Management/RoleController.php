<?php

namespace App\Http\Controllers\Dashboard\Management;

use App\Http\Controllers\Controller;
use App\Http\Requests\Management\Roles\StoreRequest;
use App\Http\Requests\Management\Roles\UpdateRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(): View
    {
        $roles = Role::all();

        return view('management.roles.index', compact('roles'));
    }

    public function create(): View
    {
        $permissions = Permission::all();

        return view('management.roles.create', compact('permissions'));
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        (Role::create($request->validated()))->syncPermissions($request->permissions);

        session()->put([
            'type' => 'success',
            'message' => 'Created!',
        ]);

        return redirect()->route('roles.index');
    }

    public function edit($id): RedirectResponse|View
    {
        $role = Role::findById($id);

        if (!$role) {
            session()->put([
                'type' => 'error',
                'message' => 'Cannot find a model with given parameter!',
            ]);

            return redirect()->back();
        }

        $permissions = Permission::all();

        return view('management.roles.edit', compact('role', 'permissions'));
    }

    public function update(UpdateRequest $request, $id): RedirectResponse
    {
        $role = Role::findById($id);

        if (!$role) {
            session()->put([
                'type' => 'error',
                'message' => 'Cannot find a model with given parameter!',
            ]);

            return redirect()->back();
        }

        $role->update($request->validated());

        $role->syncPermissions($request->permissions);

        session()->put([
            'type' => 'success',
            'message' => 'Updated successfully!',
        ]);

        return redirect()->back();
    }

    public function destroy($id): RedirectResponse
    {

        $role = Role::findById($id);

        if (!$role) {
            session()->put([
                'type' => 'error',
                'message' => 'Cannot find a model with given parameter!',
            ]);

            return redirect()->back();
        }

        $role->delete();

        session()->put([
            'type' => 'success',
            'message' => 'Deleted!',
        ]);

        return redirect()->back();
    }
}
