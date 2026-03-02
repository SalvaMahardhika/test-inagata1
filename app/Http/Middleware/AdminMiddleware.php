<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (auth('api')->user()->role !== 'admin') {
            return response()->json([
                'message' => 'No access, admin only'
            ], 403);
        }

        return $next($request);
    }
}