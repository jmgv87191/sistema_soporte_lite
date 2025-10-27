<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');


// Dashboard admin
Route::get('/admin/dashboard', function() {
    return view('admin.dashboard');
})->name('admin.dashboard')->middleware('auth');

// Dashboard user
Route::get('/user/dashboard', function() {
    return view('user.dashboard');
})->name('user.dashboard')->middleware('auth');


Route::get('/crearTicket', function () {
    return view('tickets.index');
})->middleware('auth')->name('tickets.index');

Route::get('/verTickets', function () {
    return view('tickets.verTickets');
})->middleware('auth')->name('tickets.verTickets');

