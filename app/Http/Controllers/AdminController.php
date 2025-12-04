<?php

namespace App\Http\Controllers;

use App\Models\User; // Ensure you import the User model
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');

        // Fetch only users with type = 2 (admins) or type = 3 (penyelia), filtered by name if search is provided
        $users = User::whereIn('type', [2, 3]) // Fetch users with type 2 or 3
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%');
            })
            ->orderBy('created_at', 'desc') // Sort by registration date, newest first
            ->get();

        return view('admin.index', compact('users'));
    }


    public function show($id)
    {
        // Find the user by ID and eager load the related 'post'
        $admin = User::findOrFail($id);

        // Check if the user is either an Admin (type 2) or Penyelia (type 3)
        if (!in_array($admin->type, [2, 3])) {
            abort(404); // If the user is neither admin nor penyelia, show a 404 error
        }

        return view('admin.show', [
            'admin' => $admin,
        ]);
    }


    // Show the form to edit admin's details
    public function edit(User $admin)
    {
        return view('admin.edit', compact('admin'));
    }

    // Handle the update of admin's details
    public function update(Request $request, User $admin)
    {
        // Validate the input data
        $request->validate([
            'type' => 'required|in:2,3', // Ensure type is either Pensyarah (2) or Penyelia (3)
            'name' => 'required|string|max:255',
            'user_id' => 'required|string|max:255|unique:users,user_id,' . $admin->id, // Validate user_id
            'current_position' => 'nullable|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $admin->id,
            'phone_number' => 'nullable|string|max:15',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'location' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'faculty' => 'nullable|string|max:255',
        ]);

        // Update the admin's details
        $admin->update($request->all());

        return redirect()->route('admin.show', $admin->id)
            ->with('success', 'Maklumat pensyarah berjaya dikemas kini.');
    }
}
