<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PregnantDentalCheckupController;
use App\Http\Controllers\CatenDentalCheckupController;
use App\Http\Controllers\SchoolChildDentalCheckupController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return response()->view('blank');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');


// ==================
// ROUTE PRIVATE (auth)
// ==================
Route::middleware('auth')->group(function () {
    // About page
    Route::view('/about', 'about')->name('about');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ==================
    // USERS ROUTES
    // ==================
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::patch('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    // ==================
    // PASIEN ROUTES
    // ==================
    Route::get('/pasien', [PasienController::class, 'index'])->name('pasien.index');
    Route::get('/pasien/create', [PasienController::class, 'create'])->name('pasien.create');
    Route::post('/pasien', [PasienController::class, 'store'])->name('pasien.store');
    Route::get('/pasien/{pasien}', [PasienController::class, 'show'])->name('pasien.show');
    Route::get('/pasien/{pasien}/edit', [PasienController::class, 'edit'])->name('pasien.edit');
    Route::patch('/pasien/{pasien}', [PasienController::class, 'update'])->name('pasien.update');
    Route::delete('/pasien/{pasien}', [PasienController::class, 'destroy'])->name('pasien.destroy');

    // ==================
    // PREGNANT DENTAL CHECKUPS ROUTES
    // ==================
    Route::get('/pregnant-dental-checkups', [PregnantDentalCheckupController::class, 'index'])->name('pregnant-dental-checkups.index');
    Route::get('/pregnant-dental-checkups/create', [PregnantDentalCheckupController::class, 'create'])->name('pregnant-dental-checkups.create');
    Route::get('/pregnant-dental-checkups/create/{pasien}', [PregnantDentalCheckupController::class, 'createWithPasien'])
        ->whereNumber('pasien')
        ->name('pregnant-dental-checkups.create.withPasien');
    Route::post('/pregnant-dental-checkups', [PregnantDentalCheckupController::class, 'store'])->name('pregnant-dental-checkups.store');

    // statis dulu sebelum {id}
    Route::get('/pregnant-dental-checkups/{id}/whatsapp', [PregnantDentalCheckupController::class, 'whatsappMessage'])
        ->whereNumber('id')
        ->name('pregnant-dental-checkups.whatsapp');
    Route::get('/pregnant-dental-checkups/{id}/print', [PregnantDentalCheckupController::class, 'print'])
        ->whereNumber('id')
        ->name('pregnant-dental-checkups.print');

    // baru dynamic
    Route::get('/pregnant-dental-checkups/{pregnant_dental_checkup}/edit', [PregnantDentalCheckupController::class, 'edit'])->name('pregnant-dental-checkups.edit');
    Route::patch('/pregnant-dental-checkups/{pregnant_dental_checkup}', [PregnantDentalCheckupController::class, 'update'])->name('pregnant-dental-checkups.update');
    Route::delete('/pregnant-dental-checkups/{pregnant_dental_checkup}', [PregnantDentalCheckupController::class, 'destroy'])->name('pregnant-dental-checkups.destroy');

    // ==================
    // CATEN DENTAL CHECKUPS ROUTES
    // ==================
    Route::get('/caten-dental-checkups', [CatenDentalCheckupController::class, 'index'])->name('caten-dental-checkups.index');
    Route::get('/caten-dental-checkups/create', [CatenDentalCheckupController::class, 'create'])->name('caten-dental-checkups.create');
    Route::get('/caten-dental-checkups/create/{pasien}', [CatenDentalCheckupController::class, 'createWithPasien'])
        ->whereNumber('pasien')
        ->name('caten-dental-checkups.create.withPasien');
    Route::post('/caten-dental-checkups', [CatenDentalCheckupController::class, 'store'])->name('caten-dental-checkups.store');

    // statis dulu
    Route::get('/caten-dental-checkups/{id}/whatsapp', [CatenDentalCheckupController::class, 'whatsappMessage'])
        ->whereNumber('id')
        ->name('caten-dental-checkups.whatsapp');
    Route::get('/caten-dental-checkups/{id}/print', [CatenDentalCheckupController::class, 'print'])
        ->whereNumber('id')
        ->name('caten-dental-checkups.print');

    // baru dynamic
    Route::get('/caten-dental-checkups/{caten_dental_checkup}/edit', [CatenDentalCheckupController::class, 'edit'])->name('caten-dental-checkups.edit');
    Route::patch('/caten-dental-checkups/{caten_dental_checkup}', [CatenDentalCheckupController::class, 'update'])->name('caten-dental-checkups.update');
    Route::delete('/caten-dental-checkups/{caten_dental_checkup}', [CatenDentalCheckupController::class, 'destroy'])->name('caten-dental-checkups.destroy');

    // ==================
    // SCHOOL CHILD DENTAL CHECKUPS ROUTES
    // ==================
    Route::get('/school-child-dental-checkups', [SchoolChildDentalCheckupController::class, 'index'])->name('school-child-dental-checkups.index');
    Route::get('/school-child-dental-checkups/create', [SchoolChildDentalCheckupController::class, 'create'])->name('school-child-dental-checkups.create');
    Route::get('/school-child-dental-checkups/create/{pasien}', [SchoolChildDentalCheckupController::class, 'createWithPasien'])
        ->whereNumber('pasien')
        ->name('school-child-dental-checkups.create.withPasien');
    Route::post('/school-child-dental-checkups', [SchoolChildDentalCheckupController::class, 'store'])->name('school-child-dental-checkups.store');

    // statis dulu
    Route::get('/school-child-dental-checkups/{id}/whatsapp', [SchoolChildDentalCheckupController::class, 'whatsappMessage'])
        ->whereNumber('id')
        ->name('school-child-dental-checkups.whatsapp');
    Route::get('/school-child-dental-checkups/{id}/print', [SchoolChildDentalCheckupController::class, 'print'])
        ->whereNumber('id')
        ->name('school-child-dental-checkups.print');

    // baru dynamic
    Route::get('/school-child-dental-checkups/{school_child_dental_checkup}/edit', [SchoolChildDentalCheckupController::class, 'edit'])->name('school-child-dental-checkups.edit');
    Route::patch('/school-child-dental-checkups/{school_child_dental_checkup}', [SchoolChildDentalCheckupController::class, 'update'])->name('school-child-dental-checkups.update');
    Route::delete('/school-child-dental-checkups/{school_child_dental_checkup}', [SchoolChildDentalCheckupController::class, 'destroy'])->name('school-child-dental-checkups.destroy');

    // ==================
    // AJAX ROUTES
    // ==================
    Route::get('/ajax/pasien-search', [PregnantDentalCheckupController::class, 'searchPasien'])
        ->name('ajax.pasien-search');
    Route::get('/ajax/caten-search', [CatenDentalCheckupController::class, 'searchPasien'])
        ->name('ajax.caten-search');
    Route::get('/ajax/child-search', [SchoolChildDentalCheckupController::class, 'searchPasien'])
        ->name('ajax.child-search');
});

// ==================
// ROUTE PUBLIK (tanpa auth)
// ==================
// NOTE: show diletakkan paling akhir untuk tiap resource agar tidak menelan /create

Route::get('/pregnant-dental-checkups/public/{hash}', [PregnantDentalCheckupController::class, 'showPublic'])
    ->name('pregnant-dental-checkups.public');

Route::get('/caten-dental-checkups/public/{hash}', [CatenDentalCheckupController::class, 'showPublic'])
    ->name('caten-dental-checkups.public');

Route::get('/school-child-dental-checkups/public/{hash}', [SchoolChildDentalCheckupController::class, 'showPublic'])
    ->name('school-child-dental-checkups.public');

Route::get('pregnant-dental-checkups/{pregnant_dental_checkup}',
    [PregnantDentalCheckupController::class, 'show'])
    ->name('pregnant-dental-checkups.show');

Route::get('caten-dental-checkups/{caten_dental_checkup}',
    [CatenDentalCheckupController::class, 'show'])
    ->name('caten-dental-checkups.show');

Route::get('school-child-dental-checkups/{school_child_dental_checkup}',
    [SchoolChildDentalCheckupController::class, 'show'])
    ->name('school-child-dental-checkups.show');

require __DIR__.'/auth.php';
