<?php

namespace App\Observers;

use App\Models\Device;
use Jenssegers\Agent\Agent;

class DeviceObserver
{
    public function creating(Device $device)
    {
        $agent = new Agent();
        $agent->setUserAgent($device->user_agent);

        $device->user_id = auth()->id();
        $device->platform = $agent->platform();
        $device->platform_version = $agent->version($agent->platform());
        $device->browser = $agent->browser();
        $device->browser_version = $agent->version($agent->browser());
        $device->device_type = $agent->deviceType();
    }

    public function updating(Device $device)
    {
        $device->count += 1;
    }
}
