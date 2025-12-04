<?php

namespace App\Http\Controllers;

use App\Models\Terima;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class TerimaController extends Controller
{
    /*public function index()
    {
        $terima = Terima::join('users', 'terima.user_id', '=', 'users.user_id')
            ->select('terima.*', 'users.name as name', 'users.student_course as student_course', 'users.user_id as user_id')
            ->get();

        return view('terima.index', compact('terima'));
    }*/

    public function index()
    {
        // Ambil pelajar yang telah menghantar borang Lapor Diri
        $students = DB::table('terima')
            ->join('users', 'terima.user_id', '=', 'users.user_id')
            ->select(
                'users.name as student_name',
                'users.student_course',
                'terima.created_at as submission_date',
                'terima.company_name as company_name',
                'terima.dokumen_terima as document'
            )
            ->get();

        return view('terima.index', compact('students'));
    }

    public function create()
    {
        //$terima = Terima::where('user_id', auth()->id())->get();

        $terima = Terima::where('user_id', auth()->user()->user_id)->get();
        return view('terima.create', compact('terima'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'user_id' => 'required|numeric',
            'name' => 'required|string|max:255',
            'company_name' => 'required|string|max:255', // Validasi untuk nama syarikat
            'dokumen_terima' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        // Check if the user has already submitted 3 applications
        $userSubmissions = Terima::where('user_id', $request->user_id)->count();

        // If the user has 3 submissions, delete the oldest
        if ($userSubmissions >= 1) {
            $oldestSubmission = Terima::where('user_id', $request->user_id)
                ->orderBy('created_at', 'asc') // Get the oldest submission
                ->first();

            // Delete the oldest submission file from the storage
            if ($oldestSubmission && $oldestSubmission->dokumen_terima) {
                Storage::disk('public')->delete('dokumen/' . $oldestSubmission->dokumen_terima);
            }

            // Delete the oldest submission from the database
            $oldestSubmission->delete();
        }

        // Handle file upload for dokumen_terima
        if ($request->hasFile('dokumen_terima')) {
            // Handle the file upload for dokumen_terima
            $dokumenTerimaFile = $request->file('dokumen_terima');
            $dokumenTerimaName = 'Borang_BLI04_' . $request->user_id . '.' . $dokumenTerimaFile->getClientOriginalExtension();

            // Store the file in 'uitmcareerconnect/public/storage/dokumen/'
            $dokumenTerimaFile->storeAs('dokumen', $dokumenTerimaName, 'public');

            // Set the file path
            $dokumen_terima = $dokumenTerimaName;
        }

        // Create the Terima instance and store it in the database
        Terima::create([
            'user_id' => $request->user_id,
            'name' => $request->name,
            'company_name' => $request->company_name, // Tambah nama syarikat
            'dokumen_terima' => $dokumen_terima,
            'latitude' => (float) $request->latitude,
            'longitude' => (float) $request->longitude,
            'date' => now(),
        ]);

        return redirect()->route('terima.create')->with('success', 'Maklumat anda telah dimuatnaik! Penyelia Akademik akan diberikan dalam masa terdekat.');
    }
}
