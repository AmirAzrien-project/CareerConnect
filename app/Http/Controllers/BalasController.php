<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Balas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BalasController extends Controller
{
    public function index()
    {
        $balas = Balas::join('users', 'balas.user_id', '=', 'users.user_id')
            ->select('balas.*', 'users.name as name', 'users.student_course as student_course', 'users.user_id as user_id')
            ->get();

        return view('balas.index', compact('balas'));
    }

    public function create()
    {
        // Get all submissions for the logged-in user
        //$balas = Balas::where('user_id', auth()->id())->get();

        $balas = Balas::where('user_id', auth()->user()->user_id)->get();
        return view('balas.create', compact('balas'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'user_id' => 'required|numeric', // Use user_id instead of student_id
            'name' => 'required|string|max:255',
            'dokumen_balas' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'dokumen2' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        // Check if the user has already submitted 3 applications
        $userSubmissions = Balas::where('user_id', auth()->id())->count();

        if ($userSubmissions >= 1) {
            $oldestSubmission = Balas::where('user_id', auth()->id())
                ->orderBy('created_at', 'asc') // Get the oldest submission
                ->first();

            // Delete the oldest submission files from the storage
            if ($oldestSubmission) {
                if ($oldestSubmission->dokumen_balas) {
                    Storage::disk('public')->delete('dokumen/' . $oldestSubmission->dokumen_balas);
                }
                if ($oldestSubmission->dokumen2) {
                    Storage::disk('public')->delete('dokumen/' . $oldestSubmission->dokumen2);
                }

                // Delete the oldest submission from the database
                $oldestSubmission->delete();
            }
        }

        // Get the logged-in user's ID (auth()->id() will return users.user_id)
        $userId = auth()->user()->user_id;

        // Handle file upload for dokumen_balas
        if ($request->hasFile('dokumen_balas')) {
            // If there's an old file for dokumen_balas, delete it
            if (isset($oldestSubmission) && $oldestSubmission->dokumen_balas) {
                $oldFilePath = public_path('storage/dokumen/' . $oldestSubmission->dokumen_balas);
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath); // Delete old file
                }
            }

            // Handle the file upload for dokumen_balas
            $dokumenBalasFile = $request->file('dokumen_balas');
            $dokumenBalasName = 'Borang_BLI03_' . $userId . '.' . $dokumenBalasFile->getClientOriginalExtension();

            // Define the path to save the file in 'uitmcareerconnect/public/storage/dokumen/'
            $dokumenBalasPath = public_path('storage/dokumen');

            // Ensure the directory exists
            if (!file_exists($dokumenBalasPath)) {
                mkdir($dokumenBalasPath, 0777, true);
            }

            // Move the file to the 'dokumen' folder within 'public/storage'
            $dokumenBalasFile->move($dokumenBalasPath, $dokumenBalasName);

            // Update the file path
            $dokumen_balas = $dokumenBalasName;
        }

        // Handle file upload for dokumen2
        if ($request->hasFile('dokumen2')) {
            // If there's an old file for dokumen2, delete it
            if (isset($oldestSubmission) && $oldestSubmission->dokumen2) {
                $oldFilePath = public_path('storage/dokumen/' . $oldestSubmission->dokumen2);
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath); // Delete old file
                }
            }

            // Handle the file upload for dokumen2
            $dokumen2File = $request->file('dokumen2');
            $originalDokumen2Name = pathinfo($dokumen2File->getClientOriginalName(), PATHINFO_FILENAME);
            $dokumen2Extension = $dokumen2File->getClientOriginalExtension();
            $dokumen2Name = $originalDokumen2Name . '_' . $userId . '.' . $dokumen2Extension;

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

        // Create the Balas instance and store it in the database
        $balas = new Balas();
        $balas->user_id = $userId; // This stores the users.id
        $balas->name = $request->name;
        $balas->date = now();
        $balas->dokumen_balas = $dokumenBalasName;
        $balas->dokumen2 = $dokumen2Name;

        $balas->save();

        return redirect()->route('balas.create')->with('success', 'Dokumen anda berjaya dimuatnaik!');
    }
}
