<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Selia;
use App\Models\Post;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Add this for password hashing
use Illuminate\Support\Str; // For generating unique filenames
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Notification;
use App\Notifications\WelcomeNewUser;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $role = $request->get('role');

        // Modify the query based on the selected role and order by type
        if ($role) {
            $users = User::where('type', $role)->orderBy('type')->get();
        } else {
            $users = User::orderBy('type')->get();  // Get all users and sort by type
        }

        return view('manageuser.index', [
            'users' => $users,
            'selectedUser' => null,  // Reset the selected user on page load, or populate as necessary
        ]);
    }


    public function index2()
    {
        // Get the logged-in penyelia
        $penyelia = auth()->user();

        // Ensure the user is a penyelia
        if (!$penyelia || $penyelia->type !== 3) {
            return redirect()->route('home')->with('error', 'Anda tidak mempunyai akses ke halaman ini.');
        }

        // Retrieve students assigned to the penyelia and their related data
        $students = Selia::where('penyelia_id', $penyelia->user_id)
            ->with([
                'student',
                'student.terima'  // Load 'terima' for the student to get latitude and longitude
            ])
            ->get();

        return view('paparan.index', compact('students'));
    }








    // Display a specific user
    public function show($id, Request $request)
    {
        //$users = User::all();
        //$selectedUser = User::findOrFail($id);
        //return view('manageuser.index', compact('users', 'selectedUser'));

        // Fetch the selected user by id
        $selectedUser = User::findOrFail($id);

        // Fetch the role filter from the request
        $role = $request->get('role');

        // Fetch internships related to the selected user
        $internships = Post::where('user_id', $selectedUser->id)->get();

        // Retrieve all users, potentially filtered by role
        if ($role) {
            $users = User::where('type', $role)->orderBy('type')->get();
        } else {
            $users = User::orderBy('type')->get();
        }

        // Return the view with both users and the selected user
        return view('manageuser.index', compact('users', 'selectedUser', 'role', 'internships'));
    }




    // Show the form for creating a new user
    public function create()
    {
        return view('manageuser.create');
    }

    // Store a newly created user in the database
    public function store(Request $request)
    {
        User::create($request->all());

        return redirect()->back()->with('success', 'Penambahan pengguna baru berjaya.');
    }
    /*$request->validate([
            'type' => ['required', 'integer', 'in:1,2,3'], // Validate the role (Pelajar, Pensyarah, Penyelia)
            'name' => ['required', 'string', 'max:255'],
            'no_ic' => ['nullable', 'string', 'size:12', 'regex:/^\d{12}$/'], // Malaysian IC format
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'phone_number' => ['nullable', 'string', 'min:10', 'max:15'], // Validate phone number length
            //'password' => ['required', 'confirmed', 'min:8'], // Ensure password has a minimum length
            'password' => ['required', 'confirmed'], // Ensure password has a minimum length
            'location' => ['nullable', 'string', 'max:255'], // Home address (Taman)
            'city' => ['nullable', 'string', 'max:255'], // City (Bandar)
            'state' => ['nullable', 'string', 'max:255'], // State (Negeri)
        ]);

        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => $request->type,
            'no_ic' => $request->no_ic,
            'phone_number' => $request->phone_number,
            'location' => $request->location,
            'city' => $request->city,
            'state' => $request->state,
        ]);

        return redirect()->back()->with('success', 'Penambahan pengguna baru berjaya.');
    }*/

    // Validate incoming request
    /* $validated = $request->validate([
            'type' => 'required|in:1,2,3', // Ensure 'type' is one of the allowed roles
            'name' => 'required|string|max:255',
            'no_ic' => 'nullable|string|max:12',
            'email' => 'required|email|unique:users,email|max:255', // Ensure email is unique
            'phone_number' => [
                'required',
                'regex:/^(\+?6?01)[0-9]{8,9}$/' // Malaysian phone number format
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/[a-z]/', // At least one lowercase letter
                'regex:/[A-Z]/', // At least one uppercase letter
                'regex:/[0-9]/', // At least one number
                'regex:/[@$!%*?&]/' // At least one special character
            ],
            'location' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'student_course' => 'nullable|string|max:255', // Optional for non-student types
        ]);

        // Create the user
        $user = User::create([
            'type' => $validated['type'],
            'name' => strtoupper($validated['name']), // Ensure name is in uppercase
            'no_ic' => $validated['no_ic'],
            'email' => $validated['email'],
            'phone_number' => $validated['phone_number'],
            'password' => Hash::make($validated['password']),
        ]);

        // If the user is a student, save additional academic info
        if ($user->type == 1) { // Student
            $user->student_course = $validated['student_course'];
            $user->save();
        }

        // Save the address information
        $user->address()->create([
            'location' => $validated['location'],
            'city' => $validated['city'],
            'state' => $validated['state'],
        ]);

        // Redirect with success message
        return redirect()->route('users.index')->with('success', 'Pengguna baharu telah berjaya ditambah!');*/




    // Show the form for editing a specific user
    public function edit($id)
    {
        $selectedUser = User::findOrFail($id);
        $internships = Post::all();  // Retrieve all posts for internship options

        return view('manageuser.edit', compact('selectedUser', 'internships'));
    }

    // Update a specific user in the database
    public function update(Request $request, $id)
    {
        // Validate incoming data if necessary (optional, uncomment if validation is required)
        /*$request->validate([
            'type' => 'nullable|integer', 
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
            'phone_number' => 'nullable|string|max:15',
            'location' => 'nullable|string|max:255',
            'advisor' => 'nullable|string',
            'student_course' => 'nullable|string',
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'cover_letter' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'internship' => 'required|exists:posts,id|nullable', // Ensure internship exists and is available
        ]);*/

        // Prepare the data to be updated
        $userData = $request->only([
            'type',
            'name',
            'email',
            'phone_number',
            'location',
            'state',
            'city',
            'student_course',
            'faculty',
            'advisor',
            'part',
            'logbook',
            'graduation_year',
            'current_position',
            'company',
            'mentorship_availability',
        ]);

        // Hash the password if provided
        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        // Find the user to update
        $user = User::findOrFail($id);

        // Handle internship placement (linking user to an internship via posts table)
        $internshipId = $request->input('internship'); // Get the selected internship ID (post ID)

        if ($internshipId) {
            // Remove any current internship association for the user
            DB::table('posts')
                ->where('user_id', $user->id) // Find the post that is currently associated with the user
                ->update(['user_id' => null]); // Remove the current user from the internship

            // Now associate the selected internship with the current user
            DB::table('posts')
                ->where('id', $internshipId) // Find the selected internship (post)
                ->update(['user_id' => $user->id]); // Replace with the current user's ID
        }

        // Handle file uploads for resume and cover letter if files are provided
        if ($request->hasFile('resume')) {
            $resumeFile = $request->file('resume');
            $resumeFileName = Str::slug($userData['name']) . '_' . now()->format('Ymd') . '.' . $resumeFile->getClientOriginalExtension();
            $userData['resume'] = $resumeFile->storeAs('resumes', $resumeFileName, 'public');
            $user->resume = $userData['resume']; // Save the resume path
        }

        if ($request->hasFile('cover_letter')) {
            $coverLetterFile = $request->file('cover_letter');
            $coverLetterFileName = Str::slug($userData['name']) . '_' . now()->format('Ymd') . '.' . $coverLetterFile->getClientOriginalExtension();
            $userData['cover_letter'] = $coverLetterFile->storeAs('cover_letters', $coverLetterFileName, 'public');
            $user->cover_letter = $userData['cover_letter']; // Save the cover letter path
        }

        // Update the user data and save changes to the database
        $user->update($userData);

        // Redirect to the user listing with a success message
        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    // Delete a specific user from the database
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return back()->with('success', 'User created successfully.');
    }
}
