<?php

use App\Http\Controllers\FolderController;
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
