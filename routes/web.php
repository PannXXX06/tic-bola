<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group.
|
*/

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/match/{match}', [TicketController::class, 'show'])->name('tickets.show');
Route::post('/match/{match}/register', [TicketController::class, 'store'])->name('tickets.store');
Route::get('/match/{match}/success', [TicketController::class, 'success'])->name('tickets.success');

// Admin 
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminController::class, 'loginForm'])->name('login');
    Route::post('/login', [AdminController::class, 'login'])->name('login.post');
    
    Route::middleware('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
        
        // CRUD Match
        Route::get('/matches', [MatchController::class, 'index'])->name('matches.index');
        Route::get('/matches/create', [MatchController::class, 'create'])->name('matches.create');
        Route::post('/matches', [MatchController::class, 'store'])->name('matches.store');
        Route::get('/matches/{match}', [MatchController::class, 'show'])->name('matches.show');
        Route::get('/matches/{match}/edit', [MatchController::class, 'edit'])->name('matches.edit');
        Route::put('/matches/{match}', [MatchController::class, 'update'])->name('matches.update');
        Route::delete('/matches/{match}', [MatchController::class, 'destroy'])->name('matches.destroy');

        //Sistem ticket
        Route::get('/tickets', [AdminController::class, 'ticketIndex'])->name('tickets.index');
        Route::get('/tickets/{match}', [AdminController::class, 'ticketShow'])->name('tickets.show');
        Route::get('/tickets/{match}/export', [AdminController::class, 'ticketExport'])->name('tickets.export');
    });
});