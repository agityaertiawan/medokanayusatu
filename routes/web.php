<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\NewsController as PublicNewsController;

// Admin Controllers
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\AchievementController;
use App\Http\Controllers\Admin\SchoolProfileController;
use App\Http\Controllers\ProfileController;
// Route khusus untuk AI Assistant
Route::post('/admin/news/generate-ai', [PublicNewsController::class, 'generateWithAI'])->middleware(['auth']) // Pastikan hanya admin yang bisa akses
    ->name('admin.news.generate-ai');


/*
|--------------------------------------------------------------------------
| ROUTE PUBLIK (Bisa diakses siapa saja / tanpa login)
|--------------------------------------------------------------------------
*/
Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/news/{news}', [PublicNewsController::class, 'show'])->name('news.show');
Route::get('/news/{news}/download', [PublicNewsController::class, 'downloadPdf'])->name('news.download');


/*
|--------------------------------------------------------------------------
| ROUTE ADMIN (Wajib Login & Terautentikasi)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    
    // 1. Dashboard Admin
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // 2. Integrasi OpenAI / Groq AI SDK
    Route::post('/news/generate-ai', [NewsController::class, 'generateAiContent'])->name('news.generate_ai');

    // 3. CRUD Berita & Kegiatan
    Route::resource('news', NewsController::class);

    // 4. CRUD Guru & Karyawan (Staff)
    Route::resource('staff', StaffController::class);

    // 5. CRUD Prestasi Murid
    Route::resource('achievements', AchievementController::class);

    // 6. Kelola Profil Sekolah (Visi, Misi, Sambutan)
    Route::get('/school-profile', [SchoolProfileController::class, 'edit'])->name('school_profile.edit');
    Route::put('/school-profile', [SchoolProfileController::class, 'update'])->name('school_profile.update');
});


/*
|--------------------------------------------------------------------------
| ROUTE PROFIL AKUN ADMIN (Bawaan Laravel Breeze)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';