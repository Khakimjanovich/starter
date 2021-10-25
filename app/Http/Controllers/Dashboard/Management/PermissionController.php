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
        $this->success('Created successfully!');

        return redirect()->route('permissions.index');
    }

    public function edit($id): View|RedirectResponse
    {
        $permission = Permission::findById($id);

        if (!$permission) {
            $this->error('Cannot find the model!');

            return redirect()->back();
        }

        return view('management.permissions.edit', compact('permission'));
    }

    public function update(UpdateRequest $request, $id): RedirectResponse
    {
        $permission = Permission::findById($id);
        if (!$permission) {
            $this->error('Cannot find the model!');

            return redirect()->back();
        }

        $permission->update($request->validated());

        $this->success('Updated successfully');

        return redirect()->back();
    }

    public function destroy($id): RedirectResponse
    {
        $permission = Permission::findById($id);

        if (!$permission) {
            $this->error('Cannot find the model!');

            return redirect()->back();
        }

        $permission->delete();

        $this->success('Deleted Successfully!');

        return redirect()->back();
    }
}
