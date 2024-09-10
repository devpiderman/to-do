<?php

use App\Http\Controllers\FolderController;
use App\Http\Controllers\FolderTaskController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::controller(FolderController::class)->prefix('/folders')->middleware(['auth:sanctum'])->group(function () {
    Route::get('/', 'index')->name('folders.index');
    Route::post('/', 'store')->name('folders.store');
    Route::get('/{folder}', 'show')->name('folders.show');
    Route::put('/{folder}', 'update')->name('folders.update');
    Route::delete('/{folder}', 'destroy')->name('folders.destory');
});

Route::controller(TaskController::class)->prefix('/tasks')->middleware(['auth:sanctum'])->group(function () {
    Route::get('/', 'index')->name('tasks.index');
    Route::post('/', 'store')->name('tasks.store');
    Route::get('/{task}', 'show')->name('tasks.show');
    Route::put('/{task}', 'update')->name('tasks.update');
    Route::delete('/{task}', 'destroy')->name('tasks.destory');
});

Route::controller(FolderTaskController::class)->middleware(['auth:sanctum'])->group(function () {
    Route::get('/folders/{folder}/tasks', 'index')->name('folders.tasks.index');
});

Route::controller(UserController::class)->prefix('/users')->middleware(['auth:sanctum'])->group(function () {
    Route::get('/', 'show')->name('users.show');
    Route::put('/', 'update')->name('users.update');
    Route::delete('/', 'destroy')->name('users.destroy');
});
