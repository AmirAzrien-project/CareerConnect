<?php

namespace App\Http\Controllers;

use App\Models\User; // Ensure you import the User model
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');

        // Fetch only users with type = 1 (students), filtered by name if search is provided
        $users = User::where('type', 1)
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%');
            })
            ->orderBy('created_at', 'desc') // Sort by registration date, newest first
            ->get();

        return view('student.index', compact('users'));
    }


    public function show($id)
    {
        // Find the user by ID
        $student = User::findOrFail($id);

        // Check if the user is either a User (type 1) or student (type 3)
        if ($student->type !== 2 && $student->type !== 1) {
            abort(404); // Not a valid User or student, show a 404 error
        }

        return view('student.show', [
            'student' => $student,
        ]);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('student.edit', compact('user')); // Pass user data to the edit view
    }

    public function update(Request $request, $id)
    {
        // Validate the data
        /*$request->validate([
            'user_id' => 'required|string',
            'no_ic' => 'required|string',
            'name' => 'required|string',
            'email' => 'required|email',
            'phone_number' => 'nullable|string',
            'location' => 'nullable|string',
            'city' => 'nullable|string',
            'student_course' => 'nullable|string',
            'part' => 'nullable|string',
            'advisor' => 'nullable|string',
        ]);*/


        // Update the user with the new data
        $userData = $request->only([
            'user_id',
            'no_ic',
            'name',
            'email',
            'phone_number',
            'location',
            'city',
            'student_course',
            'part',
            'advisor',
        ]);

        // Find the student by ID
        $user = User::find($id);

        $user->update($userData);

        return redirect()->route('student.show', $id)->with('success', 'Profile updated successfully!');
    }
}
