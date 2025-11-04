<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
})->middleware('auth:sanctum');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');


// Dashboard admin
Route::get('/admin/dashboard', function() {
    return view('admin.dashboard');
})->name('admin.dashboard')->middleware('auth');

Route::get('/user/dashboard', function() {
    return view('user.dashboard');
})->middleware('auth:sanctum');



Route::get('/crearTicket', function () {
    return view('tickets.index');
})->middleware('auth:sanctum');

Route::get('/verTickets', function() {
    return view('tickets.verTickets');
})->name('verTickets')->middleware('auth');


Route::get('/verTicketsUsuario', function() {
    return view('user.verTicket');
})->name('verTicketsUsuario')->middleware('auth');

Route::get('/ticket/{code}', function($code) {
    return view('tickets.ticketDetalle');
})->name('ticket')->middleware('auth');
