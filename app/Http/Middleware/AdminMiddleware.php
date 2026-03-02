<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // notif kalau belum login
        if (!auth('api')->check()) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        // notif kalau bukan admin
        if (auth('api')->user()->role !== 'admin') {
            return response()->json([
                'message' => 'No access'
            ], 403);
        }

        return $next($request);
    }
}