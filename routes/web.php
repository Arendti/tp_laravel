<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     [TicketController::class, 'dashboard'];
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [TicketController::class, 'dashboard'])->name('dashboard');
    Route::get('/tickets', [TicketController::class, 'tickets'])->name('tickets');
    Route::get('/new_ticket', [TicketController::class, 'new_ticket'])->name('new_ticket');
    Route::get('/projects', [ProjectController::class, 'projects'])->name('projects');
    // Route::get('/tickets/create', [TicketController::class, 'create'])->name('tickets.create');
    // Route::post('/tickets/store', [TicketController::class, 'store'])->name('tickets.store');
    Route::get('/tickets/{id}/show', [TicketController::class, 'show'])->name('tickets.show');
    // Route::get('/tickets/{id}/edit', [TicketController::class, 'edit'])->name('tickets.edit');
    // Route::put('/tickets/{id}/update', [TicketController::class, 'update'])->name('tickets.update');
    // Route::delete('/tickets', [TicketController::class, 'destroy'])->name('tickets.destroy');
    // Route::get('/contact', [TicketController::class, 'contact'])->name('tickets.contact');
});