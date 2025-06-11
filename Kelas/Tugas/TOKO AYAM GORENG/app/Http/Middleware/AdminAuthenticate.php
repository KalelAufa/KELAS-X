<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Periksa apakah admin sudah login (session admin_id ada)
        if (!$request->session()->has('admin_id')) {
            // Cek apakah ada cookie remember token
            $rememberToken = $request->cookie('admin_remember');

            if ($rememberToken) {
                // Cari admin dengan remember token yang cocok
                $admin = \App\Models\Admin::where('remember_token', $rememberToken)
                    ->where('is_active', true)
                    ->first();

                if ($admin) {
                    // Set session admin
                    $request->session()->put('admin_name', $admin->name);
                    $request->session()->put('admin_email', $admin->email);
                    $request->session()->put('admin_role', $admin->role);
                    $request->session()->put('admin_id', $admin->id);

                    // Update last_login
                    $admin->last_login = now();
                    $admin->save();

                    // Lanjutkan request
                    return $next($request);
                }
            }

            return redirect()->route('admin.login')->with('error', 'Silakan login terlebih dahulu');
        }

        return $next($request);
    }
}
