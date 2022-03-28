<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Jenssegers\Agent\Agent;

class DeviceFactory extends Factory
{
    public function definition(): array
    {
        $agent = new Agent();
        $user_agent = $this->faker->userAgent;
        $agent->setUserAgent($user_agent);

        return [
            'ip_address' => $this->faker->ipv4,
            'user_agent' => $user_agent,
            'route' => '/',
            'action' => 'GET',
        ];
    }
}
