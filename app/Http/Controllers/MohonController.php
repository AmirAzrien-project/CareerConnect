<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use App\Models\Mohon;
use App\Models\Mohon2;
use App\Models\Mohon3;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class MohonController extends Controller
{
    // ADMIN DISPLAY TABLE DEKAT MOHON.INDEX ------------------------------------------------------
    public function index(Request $request)
    {
        // Get the filter value from the request
        $student_course = $request->input('student_course');

        // Query 'mohon' applications, applying filter if provided
        $query = Mohon::query();
        if (!empty($student_course)) {
            $query->where('student_course', $student_course);
        }

        // Fetch filtered or all results
        // $mohons = $query->get();
        $mohons = $query->paginate(10); // Adjust the number of records per page as needed


        // Fetch distinct courses for the filter dropdown
        $courses = Mohon::select('student_course')->distinct()->pluck('student_course');

        // Return the view with the data
        return view('mohon.index', compact('mohons', 'courses'));
    }

    // UNTUK ADMIN UPLOAD SLI-01, SLI-02 & BLI-02 ------------------------------------------------------
    // UNTUK STUDENT VIEW SLI-01, SLI-02 & BLI-02 ------------------------------------------------------
    public function index2()
    {
        // Get the authenticated user
        $user = Auth::user();

        // Fetch 'mohon' records associated with the logged-in user
        // $mohons = Mohon::where('user_id', $user->id)->get();
        $mohons = Mohon::where('user_id', $user->user_id)->get(); // Use user_id as per your database schema

        // Fetch all 'mohon3' records
        $mohon3Records = Mohon3::all();

        // Initialize dokumen2 and dokumen3 file paths
        $dokumen2_paths = [];
        $dokumen3_paths = [];

        // Loop through each 'mohon3' record and generate file URLs for dokumen2 and dokumen3
        foreach ($mohon3Records as $record) {
            $dokumen2_paths[] = $record->dokumen2 ? asset('storage/dokumen/' . $record->dokumen2) : null;
            $dokumen3_paths[] = $record->dokumen3 ? asset('storage/dokumen/' . $record->dokumen3) : null;
        }

        // Pass both the 'mohon' records and 'mohon3' paths to the view
        return view('mohon2.index', compact('mohons', 'mohon3Records', 'dokumen2_paths', 'dokumen3_paths'));
    }





    public function create()
    {
        // Fetch submissions of the currently logged-in user along with related user data
        // $mohons = Mohon::where('user_id', Auth::id())->with('user')->get();
        $mohons = Mohon::where('user_id', Auth::user()->user_id)->with('user')->get();

        return view('mohon.create', compact('mohons'));
    }

    // UNTUK USER SUBMIT FORM SLI-01 ------------------------------------------------------
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'no_ic' => 'required|string|regex:/^\d{6}-\d{2}-\d{4}$/', // IC format xxxxxx-xx-xxxx
            'email' => 'required|email|max:255',
            'student_course' => 'required|string',
            'part' => 'required|integer',
            'pointer' => 'required|numeric',
            'student_address' => 'required|string|max:500',
            'parents' => 'required|string|max:255',
            'parents_address' => 'required|string|max:500',
        ]);

        // Manually set user_id if not present in the request
        if (! $request->has('user_id')) {
            $request->merge([
                'user_id' => Auth::user()->user_id, // Use user_id from the Auth model
                'date' => now(),
            ]);
        }

        // Get the user type
        $user = Auth::user();

        // If the user is type 1 (student) and already has a submission, replace the old one
        if ($user->type == 1) {
            $existingSubmission = Mohon::where('user_id', Auth::user()->user_id)->first();

            // If there's an existing submission, delete it before creating a new one
            if ($existingSubmission) {
                $existingSubmission->delete();
            }
        }

        // Create Mohon instance
        Mohon::create($request->all());

        return redirect()->route('mohon.create')->with('success', 'Permohonan anda berjaya!');
    }





    // admin update (upload SLI kepada Pelajar)
    public function edit($id)
    {
        $mohon = Mohon::findOrFail($id);  // This will retrieve the Mohon entry based on the given ID
        //$selectedUser = User::findOrFail($mohon->user_id);  // This will get the associated user data
        return view('mohon.edit', compact('mohon'));  // Pass both Mohon and User data to the view
    }

    public function update(Request $request, $id)
    {
        // Find the application by ID in the 'mohon' table
        $mohon = Mohon::findOrFail($id);

        // Prepare the data to update
        $userData = $request->only([
            'user_id',
            'name',
            'no_ic',
            'email',
            'student_course',
            'part',
            'pointer',
            'student_address',
            'parents',
            'parents_address',
            'parents_number',
        ]);

        // Update the 'mohon' record
        $mohon->update($userData);

        // Handle file upload for dokumen_mohon
        if ($request->hasFile('dokumen_mohon')) {
            $userId = $request->user_id; // Assuming user_id is provided in the request

            // Handle the file upload
            $file = $request->file('dokumen_mohon');
            $filename = 'Borang_SLI01_' . $userId . '.' . $file->getClientOriginalExtension();

            // Define the storage path
            $path = public_path('storage/cover_letters');

            // Ensure the directory exists
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            // Check and delete any existing file for this user
            $existingFilePath = $path . '/' . $filename;
            if (file_exists($existingFilePath)) {
                unlink($existingFilePath); // Remove old file
            }

            // Move the new file to the specified path
            $file->move($path, $filename);

            // Update 'dokumen_mohon' in 'mohon2' table for this user
            $mohon2 = Mohon2::where('user_id', $userId)->first();
            if ($mohon2) {
                $mohon2->dokumen_mohon = $filename;
                $mohon2->save();
            }

            // Update the user's cover_letter in the 'users' table
            $user = User::where('user_id', $userId)->first();
            if ($user) {
                // Delete any old file linked in the database
                if ($user->cover_letter && $user->cover_letter !== $filename) {
                    $oldCoverLetterPath = $path . '/' . $user->cover_letter;
                    if (file_exists($oldCoverLetterPath)) {
                        unlink($oldCoverLetterPath);
                    }
                }

                // Update the user's cover_letter field
                $user->cover_letter = $filename;
                $user->save();
            }
        }

        // Redirect back to the list with a success message
        return redirect()->route('mohon.index')->with('success', 'Application updated successfully!');
    }












    //INDEX---------------------------------------------------------------------------------------------------------
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|in:pending,approved,declined',
        ]);

        $mohon = Mohon::findOrFail($id);
        $mohon->status = $request->status;
        $mohon->save();

        return redirect()->route('mohon.index')->with('success', 'Application status updated successfully!');
    }

    public function approve(Mohon $mohon)
    {
        $this->authorize('approve', $mohon);

        $mohon->status = 'approved';
        $mohon->save();

        return redirect()->route('mohon.index')->with('success', 'Application approved!');
    }

    public function decline(Mohon $mohon)
    {
        $this->authorize('decline', $mohon);

        $mohon->status = 'declined';
        $mohon->save();

        return redirect()->route('mohon.index')->with('success', 'Application declined!');
    }
}
