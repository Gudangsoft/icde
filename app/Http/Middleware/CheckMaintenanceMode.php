<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckMaintenanceMode
{
    public function handle(Request $request, Closure $next)
    {
        // Never block admin area so maintenance can be turned off again.
        if ($request->is('admin') || $request->is('admin/*')) {
            return $next($request);
        }

        try {
            $maintenanceMode = (string) Setting::get('maintenance_mode', '0') === '1';
            $maintenanceTitle = Setting::get('maintenance_title', 'Website Sedang Maintenance');
            $maintenanceMessage = Setting::get('maintenance_message', 'Mohon maaf, website sedang dalam proses pemeliharaan. Silakan coba kembali beberapa saat lagi.');
        } catch (\Throwable $e) {
            $maintenanceMode = false;
            $maintenanceTitle = 'Website Sedang Maintenance';
            $maintenanceMessage = 'Mohon maaf, website sedang dalam proses pemeliharaan. Silakan coba kembali beberapa saat lagi.';
        }

        // Allow admin to bypass maintenance mode on the main web page
        if ($maintenanceMode && !(Auth::check() && Auth::user()->role === 'admin')) {
            return response()->view('maintenance', [
                'maintenanceTitle' => $maintenanceTitle,
                'maintenanceMessage' => $maintenanceMessage,
            ], 503);
        }

        return $next($request);
    }
}
