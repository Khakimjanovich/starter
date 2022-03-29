<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Http\Requests\Management\Users\StoreRequest;
use App\Http\Requests\Management\Users\UpdateRequest;
use App\Repositories\UserRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    private UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(): View
    {
        $users = $this->repository->all();

        return view('management.users.index', compact('users'));
    }

    public function create(): View
    {
        $roles = Role::all();

        return view('management.users.create', compact('roles'));
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $this->repository->create($request->validated());
        $this->success('Created successfully!');

        return redirect()->route('users.index');
    }

    public function show($id): View
    {
        $user = $this->repository->find($id);

        return view('management.users.show', compact('user'));
    }


    public function edit($id): View
    {
        $user = $this->repository->find($id);
        $roles = Role::all();

        return view('management.users.edit', compact('user', 'roles'));
    }


    public function update(UpdateRequest $request, $id): RedirectResponse
    {
        $user = $this->repository->find($id);
        $this->repository->syncRoles($user, $request->roles ?? []);
        $this->repository->update($user, $request->validated());
        $this->success('Updated successfully');

        return redirect()->back();
    }

    public function destroy($id): RedirectResponse
    {
        $user = $this->repository->find($id);
        $this->repository->delete($user);
        $this->success('Deleted Successfully!');

        return redirect()->back();
    }
}
