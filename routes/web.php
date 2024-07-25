<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AudioFileController;
// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    return view('home');
});

Route::get('/audio/index', [AudioFileController::class, 'index'])->name('audio.index');
Route::get('/audio/create', [AudioFileController::class, 'create'])->name('audio.create');
Route::post('/audio/store', [AudioFileController::class, 'store'])->name('audio.store');
Route::get('/audio/{id}/edit', [AudioFileController::class, 'edit'])->name('audio.edit');
Route::put('/audio/{id}', [AudioFileController::class, 'update'])->name('audio.update');
Route::get('/audio/{id}', [AudioFileController::class, 'show'])->name('audio.show');
Route::delete('/audio/{id}', [AudioFileController::class, 'destroy'])->name('audio.destroy');



