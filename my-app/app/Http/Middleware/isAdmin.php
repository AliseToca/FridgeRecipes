<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Enums\UserRole;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->role === UserRole::ADMIN) {
            return $next($request);
        }

        return response()->json(['message' => 'Forbidden: Admins only'], 403);
    }
}
