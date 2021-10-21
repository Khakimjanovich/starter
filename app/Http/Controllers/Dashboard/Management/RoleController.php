<?php

namespace App\Http\Controllers\Dashboard\Management;

use App\Http\Controllers\Controller;
use App\Http\Requests\Management\Roles\StoreRequest;
use App\Http\Requests\Management\Roles\UpdateRequest;
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

        return redirect()->route('roles.index')->withErrors([
            'status' => true,
            'error' => __('Created successfully!')
        ]);
    }

    public function edit($id): View
    {
        $role = Role::findById($id);

        $permissions = Permission::all();

        return view('management.roles.edit', compact('role','permissions'));
    }

    public function update(UpdateRequest $request, $id): RedirectResponse
    {
        $role = Role::findById($id);

        if (!$role) {
            return redirect()->back()->withErrors([
                'status' => false,
                'error' => __('Cannot find a model with given parameter')
            ]);
        }

        $role->update($request->validated());

        $role->syncPermissions($request->permissions);

        return redirect()->route('roles.index')->withErrors([
            'status' => true,
            'error' => __('Updated successfully!')
        ]);
    }

    public function destroy($id): RedirectResponse
    {
        (Role::findById($id))->delete();

        return redirect()->route('roles.index')->withErrors([
            'status' => true,
            'error' => __('Deleted successfully!')
        ]);
    }
}
