<?php

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

Route::get('services', function () {
    return view('services.index');
})->name('services');

Route::get('active_directory', function () {
    return view('active_directory.index');
})->name('active_directory');

Route::get('active_directory/register', function () {
    return view('active_directory.register');
})->name('active_directory.register');

Route::get('active_directory/login', function () {
    return view('active_directory.login');
})->name('active_directory.login');

