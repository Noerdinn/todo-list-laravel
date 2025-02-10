<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SubtaskController;
use App\Http\Controllers\TaskController;
use App\Models\Task;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome.page');

Route::middleware('auth')->group(function () {
    Route::get('/home', [AuthController::class, 'showHome'])->name('home.page');
    Route::get('/history', [TaskController::class, 'showHistory'])->name('history.page');
    Route::get('/mytasks', [TaskController::class, 'index'])->name('mytasks.page');
    Route::post('/mytasks', [TaskController::class, 'store'])->name('mytasks.store');
    // {asd} adalah paremeter
    Route::put('/mytasks/{task}', [TaskController::class, 'update'])->name('mytasks.update');
    Route::delete('/mytasks/{task}', [TaskController::class, 'destroy'])->name('mytasks.delete');
    Route::post('/mytasks/{task}/toggle', [TaskController::class, 'toggleStatus'])->name('mytask.toggle');

    // SUBTASK
    // menampilkan subtask
    Route::get('/mytasks/{id}/subtasks', [SubtaskController::class, 'show']);
    // membuat subtasks
    Route::post('/mytasks/{task}/subtask', [SubtaskController::class, 'storeSubtask'])->name('subtasks.store');
    // status subtask
    Route::patch('/subtask/{subtask}', [SubtaskController::class, 'toggleStatusSubtask'])->name('subtask.toggle');
    // hapus subtask
    Route::delete('/subtask/{subtask}', [SubtaskController::class, 'deleteSubtask'])->name('subtask.delete');
    Route::post('/home/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware('guest')->group(function () {
    Route::get('/registration', [AuthController::class, 'showRegistration'])->name('regis.show');
    Route::post('/registration/submit', [AuthController::class, 'submitRegistration'])->name('registration.submit');
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login/submit', [AuthController::class, 'autenticate'])->name('login.auth');
});


Route::get('/test/halaman', function () {
    return view('testhome');
});
