<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class LogbookController extends Controller
{
    public function index()
    {
        // Ensure only admin can access this
        if (Auth::user()->type !== 2) {
            abort(403, 'Unauthorized');
        }

        // Fetch all users with their resumes
        $users = User::whereNotNull('logbook')->get();

        return view('logbook.index', compact('users'));
    }

    // Show the logbook upload form
    public function showUploadForm()
    {
        // Ensure only students can access this
        if (Auth::user()->type !== 1 && Auth::user()->type !== 2) {
            abort(403, 'Unauthorized');
        }

        return view('logbook.upload');
    }

    // Handle the logbook upload
    public function upload(Request $request, User $selectedUser)
    {
        // Validate that the correct input name is being used for the file
        $request->validate([
            'logbook' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        // Get the authenticated user
        $user = Auth::user();

        // Check if the user has a valid student_id
        if (!$user->user_id) {
            return redirect()->back()->with('error', 'Student ID is required for uploading the logbook.');
        }

        // Handle the uploaded logbook file
        $pdfFile = $request->file('logbook');

        // Rename the file to match the required naming convention
        $fileName = 'Logbook_' . $user->user_id . '.pdf';

        // Define the storage path
        $path = public_path('storage/logbooks');

        // Ensure the directory exists
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        // Delete the old logbook if it exists
        if ($user->logbook) {
            $oldFilePath = public_path('storage/' . $user->logbook);
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }
        }

        // Move the new file to the specified folder
        $pdfFile->move($path, $fileName);

        // Save the filename to the user's logbook column
        $user->logbook = 'logbooks/' . $fileName;
        $user->save();

        return redirect()->back()->with('success', 'Logbook uploaded successfully!');
    }


    // Show the uploaded logbook
    public function view()
    {
        $user = Auth::user();
        $logbookPath = $user->logbook;

        return view('logbook.view', compact('logbookPath'));
    }
}
