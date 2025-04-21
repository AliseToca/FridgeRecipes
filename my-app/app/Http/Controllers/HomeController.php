<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        // $user = auth()->user()?->load('fridge');
        $recipes = Recipe::with('ingredients')->get();
    
        return Inertia::render('HomeView', [
            // 'auth' => [
            //     'user' => auth()->user(),
            // ],
            'recipes' => $recipes,
        ]);
    }
}