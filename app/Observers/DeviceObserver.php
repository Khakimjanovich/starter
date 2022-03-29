<?php

namespace App\Observers;

use App\Models\Device;
use Jenssegers\Agent\Agent;
use Stevebauman\Location\Facades\Location;

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

        $location = Location::get($device->ip_address);
        if ($location) {
            $device->country_name = $location->countryName;
            $device->country_code = $location->countryCode;
            $device->region_name = $location->regionName;
            $device->region_code = $location->regionCode;
            $device->city_name = $location->cityName;
            $device->zip_code = $location->zipCode;
            $device->latitude = $location->latitude;
            $device->longitude = $location->longitude;
        }
    }

    public function updating(Device $device)
    {
        $device->count += 1;
        $location = Location::get($device->ip_address);
        if ($location) {
            if ($device->country_name !== $location->countryName) {
                $device->country_name = $location->countryName;
                $device->country_code = $location->countryCode;
                $device->region_name = $location->regionName;
                $device->region_code = $location->regionCode;
                $device->city_name = $location->cityName;
                $device->zip_code = $location->zipCode;
                $device->latitude = $location->latitude;
                $device->longitude = $location->longitude;
            }
        }
    }
}
