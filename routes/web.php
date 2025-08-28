<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PregnantDentalCheckupController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CatenDentalCheckupController;
use App\Http\Controllers\SchoolChildDentalCheckupController;

Route::get('/', function () {
    return Auth::check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // About page
    Route::view('/about', 'about')->name('about');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Other resources
    Route::resource('users', UserController::class)->except(['create', 'store']);

    Route::resource('pasien', PasienController::class);

    // Pregnant Dental Checkups
    Route::resource('pregnant-dental-checkups', PregnantDentalCheckupController::class);
    Route::get('pregnant-dental-checkups/create/{pasien}', [PregnantDentalCheckupController::class, 'createWithPasien'])
    ->name('pregnant-dental-checkups.create.withPasien');
    Route::get('/ajax/pasien-search', [PregnantDentalCheckupController::class, 'searchPasien'])->name('ajax.pasien-search');
    Route::get('/pregnant-dental-checkups/{id}/whatsapp', [PregnantDentalCheckupController::class, 'whatsappMessage'])->name('pregnant-dental-checkups.whatsapp');
    Route::get('pregnant-dental-checkups/{id}/print', [PregnantDentalCheckupController::class, 'print'])
    ->name('pregnant-dental-checkups.print');

    // Caten Dental Checkups
    Route::resource('caten-dental-checkups', CatenDentalCheckupController::class);
    Route::get('caten-dental-checkups/create/{pasien}', [CatenDentalCheckupController::class, 'createWithPasien'])
    ->name('caten-dental-checkups.create.withPasien');
    Route::get('/ajax/caten-search', [CatenDentalCheckupController::class, 'searchPasien'])->name('ajax.caten-search');
    Route::get('caten-dental-checkups/{id}/whatsapp', [CatenDentalCheckupController::class, 'whatsappMessage'])->name('caten-dental-checkups.whatsapp');
    Route::get('/caten-dental-checkups/{id}/print', [CatenDentalCheckupController::class, 'print'])->name('caten-dental-checkups.print');

    // School Child Dental Checkups
    Route::resource('school-child-dental-checkups', SchoolChildDentalCheckupController::class);
    Route::get('school-child-dental-checkups/create/{pasien}', [SchoolChildDentalCheckupController::class, 'createWithPasien'])
    ->name('school-child-dental-checkups.create.withPasien');
    Route::get('/ajax/child-search', [SchoolChildDentalCheckupController::class, 'searchPasien'])->name('ajax.child-search');
    Route::get('school-child-dental-checkups/{id}/whatsapp', [SchoolChildDentalCheckupController::class, 'whatsappMessage'])->name('school-child-dental-checkups.whatsapp');
    Route::get('school-child-dental-checkups/{id}/print', [SchoolChildDentalCheckupController::class, 'print'])
    ->name('school-child-dental-checkups.print');

});

require __DIR__.'/auth.php';
