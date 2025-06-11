<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::all(); // Fetch all users

        return Inertia::render('UsersView', [
            'users' => $users,
        ]);
    }
}
