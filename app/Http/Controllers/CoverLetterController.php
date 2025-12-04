<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Smalot\PdfParser\Parser;

class CoverLetterController extends Controller
{
    public function index()
    {
        $users = User::all();

        //$users = Auth::user();
        //$coverLetterPath = $users->cover_letter ? 'storage/' . $users->cover_letter : null;

        $users = User::whereNotNull('cover_letter')->get();
        return view('coverletter.index', compact('users'));
    }

    public function showUploadForm()
    {
        // Ensure only students can access this
        if (Auth::user()->type !== 1 && Auth::user()->type !== 2) {
            abort(403, 'Unauthorized');
        }

        return view('coverletter.upload');
    }



    
    // ADMIN UPLOAD COVER-LETTER (SLI-01) STUDENT -----------------------------------------
    public function upload(Request $request, User $selectedUser)
    {
        // Validate that the correct input name is being used
        $request->validate([
            'cover_letter' => 'required|mimes:pdf|max:2048',
        ]);

        // Get the authenticated user
        $user = Auth::user();

        // Check if the user has a valid student_id
        if (!$user->user_id) {
            return redirect()->back()->with('error', 'Student ID is required for uploading the cover letter.');
        }

        // Handle the uploaded file
        $pdfFile = $request->file('cover_letter');

        // Rename the file to match the required naming convention
        $fileName = 'Borang_SLI01_' . $user->user_id . '.pdf';

        // Define the storage path
        $path = public_path('storage/cover_letters');

        // Ensure the directory exists
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        // Delete the old cover letter if it exists
        if ($user->cover_letter) {
            $oldFilePath = public_path('storage/' . $user->cover_letter);
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }
        }

        // Move the new file to the specified folder
        $pdfFile->move($path, $fileName);

        // Save the filename to the user's cover letter column
        $user->cover_letter = 'cover_letters/' . $fileName;
        $user->save();

        return redirect()->back()->with('success', 'Cover Letter uploaded successfully!');
    }
}
