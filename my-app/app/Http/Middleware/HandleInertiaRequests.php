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
            $user->load('fridge.ingredients'); 
        }

        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $user ? [
                    'id' => $user->id,
                    'name' => $user->name,
                    'username' => $user->username,
                    'bio' => $user->bio,
                    'profile_image' => $user->profile_image,
                    'email' => $user->email,
                    'fridge' => $user->fridge, 
                ] : null,
            ],
        ]);

    }
}