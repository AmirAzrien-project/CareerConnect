<?php

namespace App\Http\Controllers;

use App\Models\Mohon3;
use App\Models\Mohon2;
use App\Models\Mohon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Mohon2Controller extends Controller
{
    // UNTUK ADMIN UPLOAD SLI-02 & BLI-02 ------------------------------------------------------
    // Upload SLI02 dengan BLI02 guna Mohon2controller tapi masuk table Mohon3. pastu display guna Mohon3controller.
    // Mohon2 dengan Mohon3 sama je sebenarnya tapi malas nak rework, so Mohon2 ni tak function.. proceed Mohon3

    public function create()
    {
        // Retrieve the logged-in user's 'mohon3' data
        $mohon3 = Mohon3::where('user_id', auth()->id())->first();

        // Retrieve dokumen2 and dokumen3, or set them to null if not found
        $dokumen2 = $mohon3 ? $mohon3->dokumen2 : null;
        $dokumen3 = $mohon3 ? $mohon3->dokumen3 : null;

        return view('mohon2.create', compact('dokumen2', 'dokumen3'));
    }

    public function store(Request $request)
    {
        // Validate the file inputs
        $request->validate([
            'dokumen2' => 'nullable|mimes:pdf,doc,docx|max:2048',
            'dokumen3' => 'nullable|mimes:pdf,doc,docx|max:2048',
        ]);

        $user = auth()->user(); // Get the logged-in user

        // Retrieve the existing submission (if any) for the logged-in user
        $mohon3 = Mohon3::where('user_id', $user->id)->first();

        // Initialize the dokumen2 and dokumen3 as null
        $dokumen2 = null;
        $dokumen3 = null;

        // Handle file upload for dokumen2
        if ($request->hasFile('dokumen2')) {
            // If there's an old file for dokumen2, delete it
            if ($mohon3 && $mohon3->dokumen2) {
                $oldFilePath = public_path('storage/dokumen/' . $mohon3->dokumen2);
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath); // Delete old file
                }
            }

            // Handle the file upload for dokumen2
            $dokumen2File = $request->file('dokumen2');
            $dokumen2Name = 'Borang_SLI02_' . '(Kosong)' . '.' . $dokumen2File->getClientOriginalExtension();

            // Define the path to save the file in 'uitmcareerconnect/public/storage/dokumen/'
            $dokumen2Path = public_path('storage/dokumen');

            // Ensure the directory exists
            if (!file_exists($dokumen2Path)) {
                mkdir($dokumen2Path, 0777, true);
            }

            // Move the file to the 'dokumen' folder within 'public/storage'
            $dokumen2File->move($dokumen2Path, $dokumen2Name);

            // Update the file path
            $dokumen2 = $dokumen2Name;
        }

        // Handle file upload for dokumen3
        if ($request->hasFile('dokumen3')) {
            // If there's an old file for dokumen3, delete it
            if ($mohon3 && $mohon3->dokumen3) {
                $oldFilePath = public_path('storage/dokumen/' . $mohon3->dokumen3);
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath); // Delete old file
                }
            }

            // Handle the file upload for dokumen3
            $dokumen3File = $request->file('dokumen3');
            $dokumen3Name = 'Borang_BLI02_' . '(Kosong)' . '.' . $dokumen3File->getClientOriginalExtension();

            // Define the path to save the file in 'uitmcareerconnect/public/storage/dokumen/'
            $dokumen3Path = public_path('storage/dokumen');

            // Ensure the directory exists
            if (!file_exists($dokumen3Path)) {
                mkdir($dokumen3Path, 0777, true);
            }

            // Move the file to the 'dokumen' folder within 'public/storage'
            $dokumen3File->move($dokumen3Path, $dokumen3Name);

            // Update the file path
            $dokumen3 = $dokumen3Name;
        }

        // Check if a submission already exists for this user
        $existingSubmission = Mohon3::where('user_id', $user->id)->first();

        if ($existingSubmission) {
            // Update the existing submission with the new file paths
            $existingSubmission->update([
                'dokumen2' => $dokumen2 ? $dokumen2 : $existingSubmission->dokumen2,
                'dokumen3' => $dokumen3 ? $dokumen3 : $existingSubmission->dokumen3,
            ]);
        } else {
            // Create a new submission in the 'mohon3' table
            Mohon3::create([
                'user_id' => $user->id,
                'dokumen2' => $dokumen2,
                'dokumen3' => $dokumen3,
            ]);
        }

        // Redirect back with a success message
        return redirect()->route('mohon2.create')->with('success', 'Permohonan telah dihantar!');
    }
}
