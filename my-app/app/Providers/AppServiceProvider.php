<?php

namespace App\Providers;

use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Validation\Rules\Password;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Vite::prefetch(concurrency: 3);

        Password::defaults(function () {
            return Password::min(8)
                           ->mixedCase()
                           ->numbers()
                           ->symbols();
        });
        
        Inertia::share([
            'auth' => function () {
                $user = Auth::user();
    
                if ($user) {
                    $user->load('fridge');
                }
    
                return [
                    'user' => $user,
                    
                ];
            },
        ]);
    }
}
