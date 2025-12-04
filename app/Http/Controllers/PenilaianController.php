<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Penilaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PenilaianController extends Controller
{
    // Pelajar view penilaian.index
    public function index()
    {
        $penilaian = Penilaian::firstOrCreate(
            ['student_id' => Auth::user()->user_id],
            ['statussatu' => 'Incomplete', 'statusdua' => 'Incomplete', 'statustiga' => 'Incomplete']
        );

        return view('penilaian.index', compact('penilaian'));
    }

    // ADMIN VIEW PENILAIAN PELAJAR YANG DAH SUBMIT
    public function index2()
    {
        // Get the students who have completed their submissions (all files)
        $penilaian = Penilaian::with('student')
            ->whereNotNull('failsatu')  // At least one file is submitted
            ->orWhereNotNull('faildua')
            ->orWhereNotNull('failtiga')
            ->orWhereNotNull('failempat')
            ->get();

        return view('penilaian.index2', compact('penilaian'));
    }


    public function create()
    {
        $penilaian = Penilaian::where('student_id', Auth::user()->user_id)->first();

        // Optional: Create a new record if not found
        if (!$penilaian) {
            $penilaian = Penilaian::create([
                'student_id' => Auth::user()->user_id,
                // Add other default fields if needed
            ]);
        }

        return view('penilaian.create', compact('penilaian'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'failsatu' => 'nullable|file|mimes:pdf,jpg,png',
            'faildua' => 'nullable|file|mimes:pdf,jpg,png',
            'failtiga' => 'nullable|file|mimes:pdf,jpg,png',
            'failempat' => 'nullable|file|mimes:pdf,jpg,png',
            'student_id' => 'required|exists:users,user_id',  // Ensure the student_id is valid
        ]);

        // Retrieve the user using Auth::id()
        $user = User::find(Auth::id()); // Auth::id() returns the user_id
        if (!$user) {
            return redirect()->route('penilaian.index')->with('error', 'User not found');
        }

        // Check if the penilaian record exists for the user
        $penilaian = Penilaian::where('student_id', $user->user_id)->first();

        // If no penilaian record exists, create one
        if (!$penilaian) {
            $penilaian = new Penilaian();
            $penilaian->student_id = $user->user_id; // Ensure it's the correct user_id
        }

        // Get user's name and ID for renaming files
        $userName = $user->name;
        $userId = $user->user_id;

        // Handle file uploads and renaming
        if ($request->hasFile('failsatu')) {
            $filename = 'BLI-05_' . $userName . '_' . $userId . '.' . $request->failsatu->extension();
            $penilaian->failsatu = $request->file('failsatu')->storeAs('penilaian', $filename, 'public');
            $penilaian->statussatu = 'complete'; // Set status when file is uploaded
        } else {
            $penilaian->statussatu = $request->statussatu ?? 'incomplete'; // Use the status from request or default to 'incomplete'
        }

        if ($request->hasFile('faildua')) {
            $filename = 'BLI-07_' . $userName . '_' . $userId . '.' . $request->faildua->extension();
            $penilaian->faildua = $request->file('faildua')->storeAs('penilaian', $filename, 'public');
            $penilaian->statusdua = 'complete'; // Set status when file is uploaded
        } else {
            $penilaian->statusdua = $request->statusdua ?? 'incomplete'; // Use the status from request or default to 'incomplete'
        }

        if ($request->hasFile('failtiga')) {
            $filename = 'BLI-06_' . $userName . '_' . $userId . '.' . $request->failtiga->extension();
            $penilaian->failtiga = $request->file('failtiga')->storeAs('penilaian', $filename, 'public');
        }
        if ($request->hasFile('failempat')) {
            $filename = 'BLI-08_' . $userName . '_' . $userId . '.' . $request->failempat->extension();
            $penilaian->failempat = $request->file('failempat')->storeAs('penilaian', $filename, 'public');
        }

        // Update status based on file uploads
        if ($penilaian->failtiga && $penilaian->failempat) {
            $penilaian->statustiga = 'complete';
        }

        // Update other statuses if provided
        if ($request->statussatu) {
            $penilaian->statussatu = $request->statussatu;
        }
        if ($request->statusdua) {
            $penilaian->statusdua = $request->statusdua;
        }

        // Save the Penilaian record
        $penilaian->save();

        return redirect()->route('penilaian.index')->with('success', 'Penilaian telah dikemaskini');
    }
}
