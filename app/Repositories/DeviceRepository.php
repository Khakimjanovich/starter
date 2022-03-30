<?php

namespace App\Repositories;

use App\Models\Device;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class DeviceRepository
{
    public function all(Request $request): Collection
    {
        $devices = Device
            ::with('user')
            ->whereDate('created_at', 'LIKE', $request->date ?? Carbon::today()->format('Y-m-d'))
            ->orderBy('updated_at', 'DESC')
            ->get()
            ->groupBy('ip_address');

        return $devices->map(function ($grouped_devices) {
            $user = [];
            $platform = [];
            $browser = [];
            $device_type = [];
            $location = [];
            $request = [];
            $count = 0;
            $last_interacted = '';
            $i = 1;
            foreach ($grouped_devices as $device) {
                $user[] = $device->user?->name ?? 'Guest';
                $platform[] = $device->platform;
                $browser[] = $device->browser;
                $device_type[] = $device->device_type;
                $count += $device->count;
                $last_interacted = ($last_interacted > $device->updated_at) ? $last_interacted : $device->updated_at;
                $request[$i]['action'] = $device->action;
                $request[$i]['route'] = ((strlen($device->route) > 30)) ? substr($device->route, 0,27) . '... ' : $device->route;
                $location[$i]['country_code'] = $device->country_code ?? 'UN';
                $location[$i]['region_name'] = $device->region_name ?? '-KNOWN';

                $i++;
            }

            unset($grouped_devices);
            $returns = [];
            $returns['user'] = array_unique($user);
            $returns['platform'] = array_unique($platform);
            $returns['browser'] = array_unique($browser);
            $returns['device_type'] = array_unique($device_type);
            $returns['request'] = array_unique($request, SORT_REGULAR);
            $returns['count'] = $count;
            $returns['country'] = array_unique($location, SORT_REGULAR);
            $returns['updated_at'] = $last_interacted;
            return $returns;
        });
    }

    public function find($id)
    {
        $device = Device::find($id);
        if (!$device) {
            abort(404);
        }
        return $device;
    }

    public function update(Device $device, array $validated)
    {
        $device->fill($validated)->save();
    }

    public function delete(Device $device)
    {
        $device->delete();
    }
}
