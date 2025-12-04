<?php

namespace App\Http\Controllers;

use App\Models\Mohon3;
use Illuminate\Http\Request;

class Mohon3Controller extends Controller
{
    // UNTUK ADMIN DSIPLAY SLI-02 & BLI-02 ------------------------------------------------------ (tak pakai)

    public function index3()
    {
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

        // Pass all the data to the view
        return view('mohon2.index', compact('mohon3Records', 'dokumen2_paths', 'dokumen3_paths'));
    }
}
