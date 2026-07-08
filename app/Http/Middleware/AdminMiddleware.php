<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        
        if (!$request->user()) {
            return abort(403, 'Anda harus login terlebih dahulu.');
        }

        $role_id = $request->user()->role_id;
        $admin_role = Role::where('name', 'admin')->first()->id;
        
        if ($role_id != $admin_role) {
            return abort(403, 'Anda tidak bisa akses halaman admin.');
        }

        return $next($request);
    }
}
