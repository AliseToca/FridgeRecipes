<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::all();

        return Inertia::render('UsersView', [
            'users' => $users,
        ]);
    }

    public function destroy(User $user)
    {
        if (auth()->id() === $user->id) {
            return response()->json(['error' => 'You cannot delete your own account.'], 403);
        }
    
        $user->delete();
    
        return response()->json(['message' => 'User deleted successfully.']);
    }
    
    

}
