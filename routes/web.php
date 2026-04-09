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
    Route::post('/', [ProfileController::class, 'logout'])->name('logout');
});

// Route::post('/logout', Logout::class)
// ->middleware('auth')
// ->name('logout');

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [TicketController::class, 'dashboard'])->name('dashboard');

    Route::get('/tickets', [TicketController::class, 'tickets'])->name('tickets');
    Route::get('/new_ticket', [TicketController::class, 'new_ticket'])->name('new_ticket');
    Route::post('/tickets/store', [TicketController::class, 'store'])->name('tickets.store');
    Route::put('/tickets/{id}/addEntry', [TicketController::class, 'addEntry'])->name('tickets.addEntry');
    Route::delete('/tickets/removeEntry', [TicketController::class, 'removeEntry'])->name('tickets.removeEntry');
    Route::get('/tickets/{id}/show', [TicketController::class, 'show'])->name('tickets.show');
    Route::get('/tickets/{id}/edit', [TicketController::class, 'edit'])->name('tickets.edit');
    Route::put('/tickets/{id}/update', [TicketController::class, 'update'])->name('tickets.update');
    Route::delete('/tickets/destroy', [TicketController::class, 'destroy'])->name('tickets.destroy');

    Route::get('/projects', [ProjectController::class, 'projects'])->name('projects');
    Route::get('/new_project', [ProjectController::class, 'new_project'])->name('new_project');
    Route::post('/projects/store', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/projects/{id}/show', [ProjectController::class, 'show'])->name('projects.show');
    Route::get('/projects/{id}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::put('/projects/{id}/update', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('/projects/destroy', [ProjectController::class, 'destroy'])->name('projects.destroy');

});