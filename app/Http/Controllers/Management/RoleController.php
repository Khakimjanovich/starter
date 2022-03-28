<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Http\Requests\Management\Roles\StoreRequest;
use App\Http\Requests\Management\Roles\UpdateRequest;
use App\Repositories\RoleRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    private RoleRepository $repository;

    public function __construct(RoleRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(): View
    {
        $roles = $this->repository->all();

        return view('management.roles.index', compact('roles'));
    }

    public function create(): View
    {
        $permissions = Permission::all();

        return view('management.roles.create', compact('permissions'));
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $role = $this->repository->create($request->validated());
        $this->repository->syncPermissions($role, $request->permissions);
        $this->success('Created successfully!');

        return redirect()->route('roles.index');
    }

    public function edit($id): RedirectResponse|View
    {
        $role = $this->repository->findById($id);
        $permissions = Permission::all();

        return view('management.roles.edit', compact('role', 'permissions'));
    }

    public function update(UpdateRequest $request, $id): RedirectResponse
    {
        $role = $this->repository->findById($id);
        $this->repository->update($role, $request->validated());
        $this->repository->syncPermissions($role, $request->permissions);
        $this->success('Updated successfully');

        return redirect()->back();
    }

    public function destroy($id): RedirectResponse
    {
        $role = $this->repository->findById($id);
        $this->repository->delete($role);
        $this->success('Deleted Successfully!');

        return redirect()->back();
    }
}
