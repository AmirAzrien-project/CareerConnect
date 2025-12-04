<?php

use App\Http\Controllers\AuthController; //?????
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;

use App\Http\Controllers\PostsController; //Penempatan internship

use App\Http\Controllers\UserController; //General User atau semua
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SeliaController;
use App\Http\Controllers\AlumniController;

use App\Http\Controllers\ResumeController;
use App\Http\Controllers\CoverLetterController;
use App\Http\Controllers\LogbookController;

use App\Http\Controllers\DocumentUploadController; //Untuk admin upload docs user (manageuser.edit)
use App\Http\Controllers\InternshipApplicationController; //Mohon first time-accepted document. tapi rework balik so dah tak pakai
use App\Http\Controllers\InternshipController; //tak pakai, untuk AI tapi entahla not working

use App\Http\Controllers\MohonController; //BLI-01
use App\Http\Controllers\Mohon2Controller; //SLI-01
use App\Http\Controllers\Mohon3Controller; //SLI-02, BLI-02, Resume
use App\Http\Controllers\BalasController;  //BLI-03/04 - Maklum Balas
use App\Http\Controllers\TerimaController; //BLI-04 - Lapor Diri
use App\Http\Controllers\PenilaianController; //BLI-05, BLI-06, BLI-07, BLI-08

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

/*Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');
*/

/**Admin routes **/
Route::middleware('adminAuth')->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('adminDashboardShow');

    Route::get('/', [AdminController::class, 'index'])->name('admin.index');

    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::delete('/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::get('student/{id}/edit', [StudentController::class, 'edit'])->name('student.edit');
    Route::put('student/{id}', [StudentController::class, 'update'])->name('student.update');

    //Route::get('student/{user_id}/edit', [StudentController::class, 'edit'])->name('student.edit');
    //Route::put('student/{user_id}', [StudentController::class, 'update'])->name('student.update');

    Route::get('admin/{admin}/edit', [AdminController::class, 'edit'])->name('admin.edit');
    Route::put('admin/{admin}', [AdminController::class, 'update'])->name('admin.update');

    Route::get('/manageusers', [UserController::class, 'index'])->name('manageuser.index');
    Route::get('manageusers/create', [UserController::class, 'create'])->name('manageuser.create');
    Route::get('/manageuser/{user}/edit', [UserController::class, 'edit'])->name('manageuser.edit');
    Route::post('/documents/{user}/upload', [DocumentUploadController::class, 'upload'])->name('documents.upload');

    Route::post('mohon/{mohon}/approve', [MohonController::class, 'approve'])->name('mohon.approve');
    Route::post('mohon/{mohon}/decline', [MohonController::class, 'decline'])->name('mohon.decline');
});



/**Penyelia routes **/
Route::middleware('penyeliaAuth')->prefix('penyelia')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'penyeliaDashboard'])->name('penyeliaDashboardShow');

    // Penyelia-view-Pelajar
    Route::get('/paparan-pelajar', [UserController::class, 'index2'])->name('paparan.index');
});



/**General user routes **/
Route::middleware(['auth', 'verified'])->get('/dashboard', [DashboardController::class, 'userDashboard'])->name('dashboard');

Route::middleware('auth')->group(function () {

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // User Routes
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');


    // Student Routes
    Route::get('/student', [StudentController::class, 'index'])->name('student.index');
    Route::get('/student/{id}/view', [StudentController::class, 'show'])->name('student.show');
    Route::get('/user/{id}/profile', [UserController::class, 'show'])->name('users.show');


    // Pensyarah Routes
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/{id}/view', [AdminController::class, 'show'])->name('admin.show');
    Route::get('/user/{id}/profile', [UserController::class, 'show2'])->name('users.show');


    // Resume Routes
    Route::get('/resume', [ResumeController::class, 'index'])->name('resume.index');
    Route::get('/resume/upload', [ResumeController::class, 'showUploadForm'])->name('resume.upload');
    Route::post('/resume/upload', [ResumeController::class, 'upload'])->name('resume.upload');
    Route::post('/resume', [ResumeController::class, 'upload'])->name('resume.store');
    Route::get('/resume/{id}', [ResumeController::class, 'show'])->name('resume.show');
    Route::put('/resume/{id}', [ResumeController::class, 'update'])->name('resume.update');


    // Cover Letter Routes
    Route::get('/coverletter', [CoverLetterController::class, 'index'])->name('coverletter.index');
    Route::get('/coverletter/upload', [CoverLetterController::class, 'showUploadForm'])->name('coverletter.upload');
    Route::post('/coverletter', [CoverLetterController::class, 'upload'])->name('coverletter.store');
    Route::get('/coverletter/{id}', [CoverLetterController::class, 'show'])->name('coverletter.show');
    Route::put('/coverletter/{id}', [CoverLetterController::class, 'update'])->name('coverletter.update');


    // Logbook Routes
    Route::get('/logbook', [LogbookController::class, 'index'])->name('logbook.index');

    Route::get('/logbook/upload', [LogbookController::class, 'showUploadForm'])->name('logbook.upload');
    Route::post('/logbook/upload', [LogbookController::class, 'upload'])->name('logbook.upload.post');

    Route::post('/logbook', [LogbookController::class, 'upload'])->name('logbook.store');
    Route::get('/logbook/{id}/edit', [LogbookController::class, 'edit'])->name('logbook.edit');
    Route::put('/logbook/{id}', [LogbookController::class, 'update'])->name('logbook.update');
    Route::delete('/logbook/{id}', [LogbookController::class, 'destroy'])->name('logbook.destroy');


    // Document Upload Routes
    Route::get('/documents', [DocumentUploadController::class, 'index'])->name('documents.index');
    Route::get('/documents/create', [DocumentUploadController::class, 'create'])->name('documents.create');
    Route::post('/documents', [DocumentUploadController::class, 'store'])->name('documents.store');
    Route::get('/documents/{id}', [DocumentUploadController::class, 'show'])->name('documents.show');
    Route::put('/documents/{id}', [DocumentUploadController::class, 'update'])->name('documents.update');


    // Mohon Routes (Application)
    Route::resource('mohon', MohonController::class);
    Route::get('/mohon', [MohonController::class, 'index'])->name('mohon.index');
    Route::put('/mohon/{id}/status', [MohonController::class, 'updateStatus'])->name('mohon.updateStatus');
    Route::get('/mohon/create', [MohonController::class, 'create'])->name('mohon.create');
    Route::post('/mohon', [MohonController::class, 'store'])->name('mohon.store');
    Route::get('/mohon/{user_id}/edit', [MohonController::class, 'edit'])->name('mohon.edit');
    Route::put('/mohon/{user_id}', [MohonController::class, 'update'])->name('mohon.update');


    // Mohon2 Routes
    Route::get('/mohon2', [MohonController::class, 'index2'])->name('mohon2.index');
    Route::get('/mohon2/create', [Mohon2Controller::class, 'create'])->name('mohon2.create');
    Route::post('/mohon2/store', [Mohon2Controller::class, 'store'])->name('mohon2.store');

    //Route::get('/mohon/{id}/edit', [MohonController::class, 'edit'])->name('mohon.edit');
    //Route::put('/mohon/{id}', [MohonController::class, 'update'])->name('mohon.update');
    //Route::get('/mohon/borang', [MohonController::class, 'borang'])->name('mohon.borang');


    // Terima Routes (Acceptance)
    Route::get('/terima', [TerimaController::class, 'index'])->name('terima.index');
    Route::get('/terima/create', [TerimaController::class, 'create'])->name('terima.create');
    Route::post('/terima', [TerimaController::class, 'store'])->name('terima.store');


    // Balas Routes (Response)
    Route::get('/balas', [BalasController::class, 'index'])->name('balas.index');
    Route::get('/balas/create', [BalasController::class, 'create'])->name('balas.create');
    Route::post('/balas', [BalasController::class, 'store'])->name('balas.store');

    // Penyelia-Admin (assign pelajar)
    Route::post('penyelia/assign', [SeliaController::class, 'assignPenyelia'])->name('penyelia.assign');
    Route::get('selia/create', [SeliaController::class, 'create'])->name('selia.create');
    Route::post('selia/store', [SeliaController::class, 'assignStudents'])->name('selia.store');
    Route::patch('/selia/{studentId}/lawatan-status', [SeliaController::class, 'updateLawatanStatus']);
    Route::get('/selia', [SeliaController::class, 'index'])->name('selia.index');


    // Route::get('/pelajar-ditugaskan', [SeliaController::class, 'viewAssignedStudents'])->name('penyelia.assigned');    
    // Route::get('/penyelia/students', [SeliaController::class, 'viewAssignedStudents'])->name('penyelia.assigned_students');
    // Route::patch('/selia/{studentId}/lawatan-status', [SeliaController::class, 'updateLawatanStatus'])->name('updateLawatanStatus');
    // Route::patch('/update-lawatan-status/{studentId}', [SeliaController::class, 'updateLawatanStatus'])->name('updateLawatanStatus');


    // Penilaian
    Route::get('/penilaian', [PenilaianController::class, 'index'])->name('penilaian.index');
    Route::post('/penilaian', [PenilaianController::class, 'store'])->name('penilaian.store');

    Route::get('/penilaian/index2', [PenilaianController::class, 'index2'])->name('penilaian.index2');
});

require __DIR__ . '/auth.php';
