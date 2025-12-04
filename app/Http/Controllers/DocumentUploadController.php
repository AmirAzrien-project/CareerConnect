<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class DocumentUploadController extends Controller
{
    /**
     * Handle document uploads for resume, cover letter, and logbook.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $userId
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request, $userId)
    {
        // Find the user by ID (throw error if not found)
        $user = User::findOrFail($userId);

        // Validate the uploaded files
        $validated = $request->validate([
            'resume' => 'nullable|mimes:pdf|max:10240',  // PDF max size 10MB
            'cover_letter' => 'nullable|mimes:pdf,doc,docx|max:10240',
            'logbook' => 'nullable|mimes:pdf,doc,docx|max:10240',
        ]);

        // Handle resume upload if exists
        if ($request->hasFile('resume')) {
            $resume = $request->file('resume');
            $resumeFileName = pathinfo($resume->getClientOriginalName(), PATHINFO_FILENAME) . '_' . date('dmY') . '.' . $resume->getClientOriginalExtension();
            
            // Move file to public/storage/resumes folder
            $resume->move(public_path('storage/resumes'), $resumeFileName);
            $user->resume = 'storage/resumes/' . $resumeFileName;
        }

        // Handle cover letter upload if exists
        if ($request->hasFile('cover_letter')) {
            $coverLetter = $request->file('cover_letter');
            $coverLetterFileName = pathinfo($coverLetter->getClientOriginalName(), PATHINFO_FILENAME) . '_' . date('dmY') . '.' . $coverLetter->getClientOriginalExtension();
            
            // Move file to public/storage/cover_letters folder
            $coverLetter->move(public_path('storage/cover_letters'), $coverLetterFileName);
            $user->cover_letter = 'storage/cover_letters/' . $coverLetterFileName;
        }

        // Handle logbook upload if exists
        if ($request->hasFile('logbook')) {
            $logbook = $request->file('logbook');
            $logbookFileName = pathinfo($logbook->getClientOriginalName(), PATHINFO_FILENAME) . '_' . date('dmY') . '.' . $logbook->getClientOriginalExtension();
            
            // Move file to public/storage/logbooks folder
            $logbook->move(public_path('storage/logbooks'), $logbookFileName);
            $user->logbook = 'storage/logbooks/' . $logbookFileName;
        }

        // Save the updated user data
        $user->save();

        // Redirect back with a success message
        return back()->with('success', 'Documents uploaded successfully!');
    }
}
