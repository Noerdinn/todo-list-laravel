<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SubtaskController;
use App\Http\Controllers\TaskController;
use App\Models\Task;
use Illuminate\Support\Facades\Route;

Route::model('task', \App\Models\Task::class);
Route::get('/', function () {
    return view('welcome');
})->name('welcome.page');

Route::middleware('auth')->group(function () {
    Route::get('/home', [AuthController::class, 'showHome'])->name('home.page');
    Route::post('/home/logout', [AuthController::class, 'logout'])->name('logout');

    // TASK
    Route::get('/history', [TaskController::class, 'showHistory'])->name('history.page');
    Route::get('/mytasks', [TaskController::class, 'index'])->name('mytasks.page');
    Route::post('/mytasks', [TaskController::class, 'store'])->name('mytasks.store');
    // {asd} adalah paremeter
    // menampilkan form update
    Route::get('/mytasks/{task}/edit', [TaskController::class, 'edit'])->name('mytask.edit');
    // mensubmit form update
    Route::put('/mytasks/{task}', [TaskController::class, 'update'])->name('mytasks.update');
    Route::delete('/mytask/{id}', [TaskController::class, 'destroy'])->name('mytasks.delete');
    // toggle untuk button mark as complete
    Route::post('/mytasks/{task}/toggle', [TaskController::class, 'toggleStatus'])->name('mytask.toggle');

    // SUBTASK
    // menampilkan subtask
    Route::get('/mytasks/{id}/subtasks', [SubtaskController::class, 'show']);
    // menampilkan elemen subtask
    Route::get('/mytasks/{subtask}/html', [SubtaskController::class, 'getSubtaskHtml']);
    // membuat subtasks
    Route::post('/mytasks/{task}/subtask', [SubtaskController::class, 'storeSubtask'])->name('subtasks.store');
    // status subtask
    Route::patch('/subtasks/{subtask}', [SubtaskController::class, 'toggleStatusSubtask'])->name('subtask.toggle');
    // hapus subtask
    Route::delete('/subtask/{subtask}', [SubtaskController::class, 'deleteSubtask'])->name('subtask.delete');
});

Route::middleware('guest')->group(function () {
    Route::get('/registration', [AuthController::class, 'showRegistration'])->name('regis.show');
    Route::post('/registration/submit', [AuthController::class, 'submitRegistration'])->name('registration.submit');
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login/submit', [AuthController::class, 'autenticate'])->name('login.auth');
});
