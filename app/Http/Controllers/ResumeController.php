<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mohon2;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Smalot\PdfParser\Parser;

class ResumeController extends Controller
{
    //index admin
    public function index()
    {
        // Ensure only admin can access this
        if (Auth::user()->type !== 2) {
            abort(403, 'Unauthorized');
        }

        // Fetch all users with their resumes
        $users = User::whereNotNull('resume')->get();

        return view('resume.index', compact('users'));
    }


    // student upload
    public function showUploadForm()
    {
        // Ensure only students can access this
        if (Auth::user()->type !== 1 && Auth::user()->type !== 2) {
            abort(403, 'Unauthorized');
        }

        return view('resume.upload');
    }

    public function upload(Request $request, User $selectedUser)
    {
        // Validate that the correct input name is being used
        $request->validate([
            'resume' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        // Get the currently authenticated user
        $user = Auth::user();

        if ($request->hasFile('resume')) {
            // If there's an old file for resume in the User model, delete it
            if ($user && $user->resume) {
                $oldFilePath = public_path('storage/resumes/' . $user->resume);
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath); // Delete old file
                }
            }

            // Handle the file upload for resume
            $resumeFile = $request->file('resume');
            $originalFileName = $resumeFile->getClientOriginalName(); // Get the original file name
            $resumeName = $originalFileName; // Use the original file name

            // Define the path to save the file in 'uitmcareerconnect/public/storage/resumes/'
            $resumePath = public_path('storage/resumes');

            // Ensure the directory exists
            if (!file_exists($resumePath)) {
                mkdir($resumePath, 0777, true);
            }

            // Move the file to the 'dokumen' folder within 'public/storage'
            $resumeFile->move($resumePath, $resumeName);

            // Update the user's resume file path
            $user->resume = 'resumes/' . $resumeName;
            $user->save();

            // Now also save the resume in the 'mohon2' model (assuming there's a relationship between User and Mohon2)
            // First, check if a 'mohon2' record exists for the current user
            $mohon2 = Mohon2::where('user_id', $user->id)->first();

            if ($mohon2) {
                // If a 'mohon2' record exists, update the resume field
                $mohon2->resume = 'resumes/' . $resumeName;
                $mohon2->save();
            } else {
                // If no 'mohon2' record exists, you can create a new one (optional)
                Mohon2::create([
                    'user_id' => $user->user_id,
                    'student_id' => $user->student_id, // Ensure this exists in users.user_id
                    'resume' => 'resumes/' . $resumeName,
                ]);
            }

            return redirect()->back()->with('success', 'Resume uploaded successfully!');
        }
    }
}
