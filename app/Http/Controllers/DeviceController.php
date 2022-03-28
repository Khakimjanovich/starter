<?php

namespace App\Http\Controllers;

use App\Repositories\DeviceRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    private DeviceRepository $repository;

    public function __construct(DeviceRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request): View
    {
        $devices = $this->repository->all($request);

        return view('devices.index', compact('devices'));
    }
}
