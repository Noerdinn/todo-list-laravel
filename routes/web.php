<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TodoController;
use App\Models\Task;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome.page');

Route::middleware('auth')->group(function () {
    Route::get('/home', [AuthController::class, 'showHome'])->name('home.page');
    Route::get('/mydays', function () {
        return view('mydays');
    })->name('mydays.page');
    Route::get('/mytasks', [TaskController::class, 'index'])->name('mytasks.page');
    Route::post('/mytasks', [TaskController::class, 'store'])->name('mytasks.store');
    Route::put('/mytasks/{task}', [TaskController::class, 'update'])->name('mytasks.update');
    Route::delete('/mytasks/{task}', [TaskController::class, 'destroy'])->name('mytasks.delete');
    Route::post('/mytasks/{task}/toggle', [TaskController::class, 'toggleStatus'])->name('mytask.toggle');
    Route::get('/mytasks/{id}/subtasks', [TaskController::class, 'showDetail']);
    Route::post('/home/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware('guest')->group(function () {
    Route::get('/registration', [AuthController::class, 'showRegistration'])->name('regis.show');
    Route::post('/registration/submit', [AuthController::class, 'submitRegistration'])->name('registration.submit');
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login/submit', [AuthController::class, 'autenticate'])->name('login.auth');
});

Route::get('/test', function () {
    return view('testhome');
});
