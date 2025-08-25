<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.index');
})->name('home');

Route::get('/about', function () {
    return view('pages.about');
})->name('about');

Route::get('/services', function () {
    return view('pages.services');
})->name('services');

Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');

Route::post('/contact/submit', [App\Http\Controllers\ContactController::class, 'store'])->name('contact.submit');

// Authentication Routes
Route::middleware(['web'])->group(function () {
    Route::get('/admin/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])
        ->middleware('guest')
        ->name('login');
    Route::post('/admin/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])
        ->middleware('guest');
    Route::post('/admin/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])
        ->name('logout');
});

// Admin routes
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    // Profile Routes
    Route::get('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('profile.update');

    Route::get('/contacts', [App\Http\Controllers\Admin\ContactController::class, 'index'])->name('contacts.index');
    Route::get('/contacts/{contact}', [App\Http\Controllers\Admin\ContactController::class, 'show'])->name('contacts.show');
    Route::patch('/contacts/{contact}/status', [App\Http\Controllers\Admin\ContactController::class, 'updateStatus'])->name('contacts.update-status');

    // Contact Follow-ups
    Route::post('/contacts/{contact}/follow-ups', [App\Http\Controllers\Admin\ContactFollowUpController::class, 'store'])->name('contacts.follow-ups.store');
    Route::delete('/contacts/{contact}/follow-ups/{followUp}', [App\Http\Controllers\Admin\ContactFollowUpController::class, 'destroy'])->name('contacts.follow-ups.destroy');
});
