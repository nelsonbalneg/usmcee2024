<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\App;

class BypassMaintenanceForAllowedIPs
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
         // Define a list of allowed IPs
         $allowedIps = ['172.16.0.246','192.168.207.247']; // Add any other allowed IPs here

         // Check if the app is in maintenance mode and if the IP is allowed
         if (App::isDownForMaintenance() && !in_array($request->ip(), $allowedIps)) {
             abort(503); // Show the maintenance page for all other IPs
         }

         return $next($request); // Allow access for allowed IPs
    }
}
