<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $user = auth()->user()?->load('fridge.ingredients'); // 👈 load fridge with ingredients
        $recipes = Recipe::with('ingredients')->get(); // 👈 load recipe ingredients

        return Inertia::render('HomeView', [
            'auth' => [
                'user' => $user,
            ],
            'recipes' => $recipes,
        ]);
    }
}
