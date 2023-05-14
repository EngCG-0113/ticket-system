<?php
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

const CONTROLLER = 'App\\Http\\Controllers\\';

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [CONTROLLER.ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [CONTROLLER.ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [CONTROLLER.ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('tickets')->group(function() {
        Route::get('/', [CONTROLLER.TicketController::class, 'index'])->name('ticket.index');
        Route::get('/add', [CONTROLLER.TicketController::class, 'create'])->name('ticket.index');
    });
});

require __DIR__.'/auth.php';
