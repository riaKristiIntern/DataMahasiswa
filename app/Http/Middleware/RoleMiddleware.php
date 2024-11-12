<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, $roles)
    {
        // Cek apakah pengguna terautentikasi
        if (Auth::check()) {
            Log::info('User is authenticated: ' . Auth::user()->email); // Logging email pengguna yang terautentikasi
            $rolesArray = explode('|', $roles);
            Log::info('User Role: ' . Auth::user()->role); // Logging role pengguna

            // Cek apakah role pengguna ada di dalam array
            if (in_array(Auth::user()->role, $rolesArray)) {
                return $next($request);
            }
        } else {
            Log::info('User is not authenticated.'); // Logging jika pengguna tidak terautentikasi
        }

        return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses ke halaman ini');
    }
}
