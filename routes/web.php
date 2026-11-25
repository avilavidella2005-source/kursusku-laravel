<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\ProfileController;

// ==========================================
// 1. ROUTE PUBLIK & LOGIN
// ==========================================
Route::get('/', [HomeController::class, 'index'])->name('home');

// Route untuk Halaman Login Admin (Sesuai Screenshot Anda)
Route::get('/admin/login', function () {
    // Ini akan memanggil file resources/views/auth/login-admin.blade.php
    return view('auth.login-admin'); 
})->name('admin.login');

// Data dummy untuk keperluan testing katalog kursus
$coursesData = [
    1 => ['name' => 'Web Dasar', 'quota' => 30, 'registered' => 12],
    2 => ['name' => 'PHP Dasar', 'quota' => 30, 'registered' => 18],
    3 => ['name' => 'PHP Lanjutan', 'quota' => 25, 'registered' => 24],
    4 => ['name' => 'Laravel Fundamental', 'quota' => 25, 'registered' => 25],
    5 => ['name' => 'MySQL Dasar', 'quota' => 20, 'registered' => 0],
    6 => ['name' => 'UI Web Dasar', 'quota' => 35, 'registered' => 9],
];

Route::get('/pendaftaran', function () use ($coursesData) {
    return view('enrollments.form_pendaftaran', ['courses' => $coursesData]);
})->name('enrollments.preview.form');

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
    return back()->with('success', 'Pendaftaran berhasil divalidasi!')->withInput();
})->name('enrollments.preview');

Route::get('/courses/{course}/availability', function (int $course) use ($coursesData) {
    abort_unless(isset($coursesData[$course]), 404);
    $data = $coursesData[$course];
    $remaining = max(0, $data['quota'] - $data['registered']);
    return response()->json(['course' => $data['name'], 'remaining' => $remaining]);
})->name('courses.availability');


// ==========================================
// 2. ROUTE TERLINDUNGI (Wajib Login)
// ==========================================
Route::middleware(['auth', 'verified'])->group(function () {
    
    // PERUBAHAN UTAMA: /dashboard dialihkan ke halaman Profil
    Route::get('/dashboard', function () {
        return redirect()->route('profile.edit');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route untuk Manajemen Kursus & Pendaftaran
    Route::resource('courses', CourseController::class);
    Route::resource('enrollments', EnrollmentController::class)->only(['index', 'create', 'store']);
});

// Memanggil route autentikasi bawaan Laravel (login, register, logout, dll)
require __DIR__.'/auth.php';