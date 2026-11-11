<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController; // Tambahan Week 12

// ==========================================
// ROUTE PERTEMUAN 7 - 9 (Beranda & Form Ajax)
// ==========================================

// 1. Route Beranda
Route::get('/', [HomeController::class, 'index'])->name('home');

// 2. Data Dummy Kursus (Untuk Form Pendaftaran & Ajax)
$coursesData = [
    1 => ['name' => 'Web Dasar', 'quota' => 30, 'registered' => 12],
    2 => ['name' => 'PHP Dasar', 'quota' => 30, 'registered' => 18],
    3 => ['name' => 'PHP Lanjutan', 'quota' => 25, 'registered' => 24],
    4 => ['name' => 'Laravel Fundamental', 'quota' => 25, 'registered' => 25],
    5 => ['name' => 'MySQL Dasar', 'quota' => 20, 'registered' => 0],
    6 => ['name' => 'UI Web Dasar', 'quota' => 35, 'registered' => 9],
];

// 3. Route Form Pendaftaran (Tampilkan Halaman)
Route::get('/pendaftaran', function () use ($coursesData) {
    return view('enrollments.form_pendaftaran', ['courses' => $coursesData]);
})->name('enrollments.preview.form');

// 4. Route Proses Form (Validasi Data)
Route::post('/pendaftaran/preview', function (Request $request) {
    $request->validate([
        'name' => ['required', 'string', 'min:3', 'max:100'],
        'email' => ['required', 'email'],
        'phone' => ['required', 'string', 'max:15'],
        'program_studi' => ['required', 'string'],
        'course_id' => ['required', 'integer'],
        'method' => ['required', 'string'],
        'participant_type' => ['required', 'string'],
        'interest' => ['required', 'string'],
        'notes' => ['nullable', 'string'],
    ]);

    return back()->with('success', 'Pendaftaran berhasil divalidasi! Data Anda telah kami terima.')->withInput();
})->name('enrollments.preview');

// 5. Route JSON Ajax (Cek Ketersediaan Kursi)
Route::get('/courses/{course}/availability', function (int $course) use ($coursesData) {
    abort_unless(isset($coursesData[$course]), 404);
    
    $data = $coursesData[$course];
    $remaining = max(0, $data['quota'] - $data['registered']);
    
    return response()->json([
        'course' => $data['name'], 
        'remaining' => $remaining
    ]);
})->name('courses.availability');

// ==========================================
// ROUTE PERTEMUAN 10-11 (CRUD Course)
// ==========================================
Route::resource('courses', CourseController::class);

// ==========================================
// ROUTE PERTEMUAN 12 (Relasi Enrollment)
// ==========================================
Route::resource('enrollments', EnrollmentController::class)->only(['index', 'create', 'store']);