<?php

namespace App\Http\Middleware;

use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    protected $rootView = 'app';

    public function share($request)
    {
        $user = $request->user();

        if ($user) {
            $user->load('fridge');
        }

        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $user ? [
                    'id' => $user->id,
                    'name' => $user->name,
                    'username' => $user->username,
                    'email' => $user->email,
                    'fridge' => $user->fridge, 
                ] : null,
            ],
        ]);
    }
}