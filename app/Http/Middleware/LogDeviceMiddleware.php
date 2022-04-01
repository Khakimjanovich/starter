<?php

namespace App\Http\Middleware;

use App\Models\Device;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;

class LogDeviceMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $date = Carbon::today()->format('Y-m-d');

        Device::updateOrCreate([
            ['ip_address', '=', $request->ip()],
            ['route', '=', $request->getRequestUri()],
            ['action', '=', $request->method()],
            ['created_at', 'LIKE', "$date%"],
            ['user_id', '=', $request->user()?->id],
        ], [
            'ip_address' => $request->ip(),
            'route' => $request->getRequestUri(),
            'action' => $request->method(),
            'payload' => $request->getContent(),
            'user_agent' => $request->userAgent(),
            'headers' => $request->headers->all(),
        ]);

        return $next($request);
    }
}
