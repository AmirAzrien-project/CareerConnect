<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Post;
use App\Models\User;
use App\Models\Mohon;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function penyeliaDashboard(Request $request)
    {
        $admins = User::where('type', 2)->get();

        $query = User::where('type', 1);
        if ($request->has('student_course') && $request->student_course != '') {
            $query->where('student_course', $request->student_course);
        }
        $users = $query->paginate(5);

        // Fetch dokumen_mohon for the logged-in user
        $dokumenMohon = Auth::user()->dokumenMohon;

        return view('penyeliaDashboard', compact('users', 'admins', 'dokumenMohon'));
    }

    public function adminDashboard(Request $request)
    {
        // Ambil senarai admin (tanpa pagination, tetapi anda boleh tambahkan jika perlu)
        $admins = User::where('type', 2)->get();

        // Ambil pelajar berdasarkan 'student_course' jika ada
        $query = User::where('type', 1); // Hanya pengguna biasa (type = 1)
        if ($request->has('student_course') && $request->student_course != '') {
            $query->where('student_course', $request->student_course);
        }
        $users = $query->paginate(5);

        // Ambil dokumen_mohon untuk pengguna yang sedang log masuk
        $dokumenMohon = Auth::user()->dokumenMohon;

        // Pisahkan pelajar berdasarkan status (Pending dan Complete)
        $studentsPending = DB::table('users')
            ->leftJoin('terima', 'users.user_id', '=', 'terima.user_id')
            ->select(
                'users.user_id',
                'users.name as student_name',
                'users.student_course',
                DB::raw('0 as status') // Pending
            )
            ->where('users.type', 1) // Hanya pelajar
            ->whereNull('terima.user_id') // Tiada data dalam 'terima'
            ->paginate(10, ['*'], 'pending_page');

        $studentsComplete = DB::table('users')
            ->join('terima', 'users.user_id', '=', 'terima.user_id')
            ->select(
                'users.user_id',
                'users.name as student_name',
                'users.student_course',
                DB::raw('1 as status') // Complete
            )
            ->where('users.type', 1) // Hanya pelajar
            ->paginate(10, ['*'], 'complete_page');

        return view('adminDashboard', compact('users', 'admins', 'dokumenMohon', 'studentsPending', 'studentsComplete'));
    }


    public function userDashboard(Request $request)
    {
        $admins = User::where('type', 2)->get();

        $query = User::where('type', 1);
        if ($request->has('student_course') && $request->student_course != '') {
            $query->where('student_course', $request->student_course);
        }
        $users = $query->paginate(5);

        // Fetch dokumen_mohon for the logged-in user
        $coverLetter = Auth::user()->cover_letter;

        return view('userDashboard', compact('users', 'admins', 'coverLetter'));
    }




    public function show($id)
    {
        $user = User::findOrFail($id); // Cari pengguna berdasarkan ID
        return view('student.show', compact('user')); // Hantar data ke pandangan 'user.profile'
    }

    public function show2($id)
    {
        $admin = User::findOrFail($id); // Cari pengguna berdasarkan ID
        return view('admin.show', compact('admin')); // Hantar data ke pandangan 'user.profile'
    }
}
