<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\Device;
use App\Repositories\DeviceRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DeviceController extends Controller
{
    private DeviceRepository $repository;

    public function __construct(DeviceRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @throws AuthorizationException
     */
    public function index(Request $request): View
    {
        Gate::forUser($request->user())->authorize('viewAny', Device::class);

        $devices = $this->repository->all($request);

        return view('devices.index', compact('devices'));
    }
}
