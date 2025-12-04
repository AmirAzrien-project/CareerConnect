<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Selia;
use App\Models\Mohon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SeliaController extends Controller
{
    // Display form for assigning students to a penyelia
    public function create(Request $request)
    {
        $penyelia = User::where('type', 3)->get(); // Dapatkan semua Penyelia

        $studentsQuery = User::where('users.type', 1);  // Tambah 'users' untuk elak kekeliruan
        // $studentsQuery = User::where('type', 1); // Dapatkan semua pelajar (type 1)

        // $studentsQuery = Mohon::query();  // Tukar kepada Mohon

        // Periksa jika penyelia_id dipilih
        if ($request->has('penyelia_id')) {
            $selectedPenyelia = User::find($request->penyelia_id); // Cari Penyelia berdasarkan ID
            if ($selectedPenyelia && $selectedPenyelia->type == 3) {
                session(['selected_penyelia' => $selectedPenyelia]); // Simpan ke dalam sesi
            } else {
                return redirect()->route('selia.create')->with('error', 'Penyelia tidak sah.');
            }
        }

        // Teruskan dengan penapisan pelajar
        if ($request->has('student_course')) {
            $studentsQuery->where('student_course', $request->student_course);
        }

        if ($request->has('search')) {
            $studentsQuery->where('name', 'like', '%' . $request->search . '%');
        }

        $students = $studentsQuery
            ->leftJoin('selia', 'selia.student_id', '=', 'users.user_id')
            ->leftJoin('users as penyelia', 'selia.penyelia_id', '=', 'penyelia.user_id')
            ->select(
                'users.id as student_id',
                'users.name as student_name',
                'penyelia.name as penyelia_name',
                'users.student_course'
            )
            ->orderBy('users.created_at', 'desc') // Sort by registration date, newest first
            ->paginate(20);
        //->get(); // Tukar dari paginate ke get()

        return view('selia.create', compact('penyelia', 'students'));
    }




    // Assign penyelia to session
    public function assignPenyelia(Request $request)
    {
        $request->validate([
            'penyelia_id' => 'required|exists:users,id',
        ]);

        $penyelia = User::where('type', 3)->find($request->penyelia_id);

        if (!$penyelia) {
            return redirect()->route('selia.create')->with('error', 'Penyelia tidak sah.');
        }

        session(['selected_penyelia' => $penyelia]);

        return redirect()->route('selia.create')->with('success', 'Penyelia telah dipilih.');
    }


    public function assignStudents(Request $request)
    {
        // Validate the student selection
        $request->validate([
            'student_id' => 'required|array',
            'student_id.*' => 'exists:users,id',
        ]);

        // Get the selected penyelia from session
        $penyelia = session('selected_penyelia');

        if (!$penyelia || $penyelia->type !== 3) {
            return redirect()->route('selia.create')->with('error', 'Pilih penyelia yang sah.');
        }

        $existingAssignments = [];

        foreach ($request->student_id as $student_id) {
            $student = User::find($student_id);

            if ($student && $student->type == 1) {
                // Check if the student is already assigned to any penyelia
                $existingSelia = Selia::where('student_id', $student->user_id)->first();

                if ($existingSelia) {
                    // If the student is assigned to a different penyelia, replace the old assignment
                    if ($existingSelia->penyelia_id !== $penyelia->user_id) {
                        // Delete the old assignment
                        $existingSelia->delete();

                        // Create a new assignment with the current penyelia
                        Selia::create([
                            'penyelia_id' => $penyelia->user_id,
                            'penyelia_name' => $penyelia->name,
                            'student_id' => $student->user_id,
                            'student_name' => $student->name,
                        ]);
                    } else {
                        // If the student is already assigned to the same penyelia, skip the creation
                        $existingAssignments[] = [
                            'student' => $student->name,
                            'penyelia_name' => $penyelia->name,
                        ];
                    }
                } else {
                    // If no existing assignment, create a new one
                    Selia::create([
                        'penyelia_id' => $penyelia->user_id,
                        'penyelia_name' => $penyelia->name,
                        'student_id' => $student->user_id,
                        'student_name' => $student->name,
                    ]);
                }
            } else {
                return redirect()->route('selia.create')->with('error', 'Pelajar tidak sah.');
            }
        }

        // If there are any existing assignments (same penyelia), show the message
        if (!empty($existingAssignments)) {
            return redirect()->route('selia.create')->with('existing_assignments', $existingAssignments);
        }

        return redirect()->route('selia.create')->with('success', 'Proses pemilihan telah berjaya.');
    }





    // Penyelia-view-Pelajar
    public function viewAssignedStudents()
    {
        // Dapatkan pengguna yang log masuk
        $penyelia = auth()->user();

        // Pastikan pengguna adalah penyelia
        if (!$penyelia || $penyelia->type !== 3) {
            return redirect()->route('home')->with('error', 'Anda tidak mempunyai akses ke halaman ini.');
        }

        // Dapatkan senarai pelajar yang ditetapkan kepada penyelia ini
        $students = Selia::where('penyelia_id', $penyelia->user_id) // Cari pelajar berdasarkan penyelia_id
            ->select('student_name', 'student_course', 'created_at as assigned_date') // Pilih data yang diperlukan
            ->paginate(10);

        // Kembalikan paparan dengan data pelajar
        return view('penyelia.assigned_students', compact('students'));
    }







    public function updateLawatanStatus($studentId)
    {
        // Fetch the Selia record associated with the student
        $selia = Selia::where('student_id', $studentId)->first();

        if (!$selia) {
            return response()->json(['status' => 'error', 'message' => 'Pelajar tidak ditemui!']);
        }

        // Toggle the lawatan_status between 'selesai' and 'belum'
        $newStatus = $selia->lawatan_status === 'Selesai' ? 'Belum' : 'Selesai';

        // Update the status
        $selia->lawatan_status = $newStatus;

        // Save the changes
        $selia->save();

        // Respond with a success message
        return response()->json(['status' => 'success', 'message' => 'Status berjaya dikemas kini!']);
    }






    //UNTUK PELAJAR VIEW SIAPA PENYELIA DIA (selia.index)
    public function index(Request $request)
    {
        // Fetch all students with their Penyelia, even if they don't have a Penyelia
        $students = User::leftJoin('selia', 'users.user_id', '=', 'selia.student_id') // Left join with selia
            ->leftJoin('users as penyelia', 'selia.penyelia_id', '=', 'penyelia.user_id') // Left join with users for penyelia
            ->where('users.type', 1) // Ensure only students (type 1) are selected
            ->select(
                'users.user_id as student_id',
                'users.name as student_name',
                'users.student_course',
                'penyelia.name as penyelia_name' // If no penyelia, this will be null
            )
            ->orderBy('users.name', 'asc') // Order alphabetically by student name
            ->paginate(20); // Pagination

        return view('selia.index', compact('students'));
    }
}
