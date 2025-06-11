<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Inertia\Inertia;
use App\Enums\UserRole;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->role === UserRole::ADMIN) {
            return $next($request);
        }

        return Inertia::render('Errors/Forbidden', [
            'status' => 403,
            'message' => 'Forbidden: Admins only',
        ])->toResponse($request)->setStatusCode(403);

    }
}
