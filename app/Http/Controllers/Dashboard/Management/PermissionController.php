<?php

namespace App\Http\Controllers\Dashboard\Management;

use App\Http\Controllers\Controller;
use App\Http\Requests\Management\Permissions\StoreRequest;
use App\Http\Requests\Management\Permissions\UpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index(): View
    {
        $permissions = Permission::all();

        return view('management.permissions.index', compact('permissions'));
    }

    public function create(): View
    {
        return view('management.permissions.create');
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        Permission::create($request->validated());

        return redirect()->route('permissions.index');
    }

    public function show($id): View
    {
        $permission = Permission::findById($id);

        return view('management.permissions.show', compact('permission'));
    }

    public function edit($id): View
    {
        $permission = Permission::findById($id);

        return view('management.permissions.edit', compact('permission'));
    }

    public function update(UpdateRequest $request, $id): RedirectResponse
    {
        (Permission::findById($id))->update($request->validated());

        return redirect()->route('permissions.index');
    }

    public function destroy($id): RedirectResponse
    {
        $permission = Permission::findById($id);

        $permission->delete();

        return redirect()->route('permissions.index');
    }
}
