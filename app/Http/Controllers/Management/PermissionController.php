<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Http\Requests\Management\Permissions\StoreRequest;
use App\Http\Requests\Management\Permissions\UpdateRequest;
use App\Repositories\PermissionRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PermissionController extends Controller
{
    private PermissionRepository $repository;

    public function __construct(PermissionRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(): View
    {
        $permissions = $this->repository->all();
        return view('management.permissions.index', compact('permissions'));
    }

    public function create(): View
    {
        return view('management.permissions.create');
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $this->repository->create($request->validated());
        $this->success('Created successfully!');

        return redirect()->route('permissions.index');
    }

    public function edit($id): View|RedirectResponse
    {
        $permission = $this->repository->findById($id);

        return view('management.permissions.edit', compact('permission'));
    }

    public function update(UpdateRequest $request, $id): RedirectResponse
    {
        $permission = $this->repository->findById($id);
        $this->repository->update($permission, $request->validated());
        $this->success('Updated successfully');

        return redirect()->back();
    }

    public function destroy($id): RedirectResponse
    {
        $permission = $this->repository->findById($id);
        $this->repository->delete($permission);
        $this->success('Deleted Successfully!');

        return redirect()->back();
    }
}
