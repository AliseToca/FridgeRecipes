<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\SavedRecipe;
use App\Models\Recipe;

class ProfileController extends Controller
{  public function index()
    {
        $user = auth()->user();
    
        $savedRecipes = Recipe::with(['ingredients'])
            ->whereHas('savedByUsers', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->get();
    
        return Inertia::render('Profile', [
            'auth' => [
                'user' => $user,
            ],
            'savedRecipes' => $savedRecipes,
        ]);
    }
    
    
    
    /**
     * Display the user's profile form.
     */
    // public function edit(Request $request): Response
    // {
    //     return Inertia::render('Profile/Edit', [
    //         'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
    //         'status' => session('status'),
    //     ]);
    // }

    // public function edit()
    // {
    //     return Inertia::render('Profile', [
    //         'auth' => [
    //             'user' => Auth::user(),
    //         ],
    //     ]);
    // }
    
    public function update(Request $request)
    {
        $user = auth()->user();
    
        $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'bio' => 'nullable|string|max:90',
            'profile_image' => 'nullable|image|max:2048',
        ]);
    
        $user->username = $request->username;
        $user->bio = $request->bio;
    
        if ($request->hasFile('profile_image')) {
            $path = $request->file('profile_image')->store('images/profile', 'public');
            $user->profile_image = $path;
        }
    
        $user->save();
    
        return response()->json(['message' => 'Profile updated']);
    }
    

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
