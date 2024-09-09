<?php

use App\Http\Controllers\FolderController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

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
