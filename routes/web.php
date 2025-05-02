<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('contact', function () {
    return view('contact.index');
})->name('contact');

Route::get('about', function () {
    return view('about.index');
})->name('about');

Route::get('what_we_offer', function () {
    return view('what_we_offer.index');
})->name('what_we_offer');

Route::get('active_directory', function () {
    return view('active_directory.index');
})->name('active_directory');

Route::get('active_directory/register', function () {
    return view('active_directory.register');
})->name('active_directory.register');

Route::get('active_directory/login', function () {
    return view('active_directory.login');
})->name('active_directory.login');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
