<?php

namespace App\Http\Controllers;

use App\Models\User; // Ensure you import the User model
use Illuminate\Http\Request;

class AlumniController extends Controller
{
    public function index(Request $request)
    {
        // Get all Alumni users
        $users = User::where('type', 3)->get(); // 3 = Alumni

        return view('alumni.index', [
            'users' => $users,
        ]);
    }

    public function show($id)
    {
        // Find the user by ID and also retrieve the related post (internship) data
        $alumni = User::with('post')->findOrFail($id); // Use with() to eager load the related 'post'

        // Check if the user is either a User (type 1) or Alumni (type 3)
        if ($alumni->type !== 2 && $alumni->type !== 3) {
            abort(404); // Not a valid User or Alumni, show a 404 error
        }

        return view('alumni.show', [
            'alumni' => $alumni,
        ]);
    }
}
