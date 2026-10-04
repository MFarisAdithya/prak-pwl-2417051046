<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\profileController;
use App\Http\Controllers\MataKuliahController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/profile/{nama?}/{npm?}/{kelas?}', [profileController::class, 'profile'])->name('profile');

Route::get('/matakuliah', [MataKuliahController::class, 'index']);
Route::get('/matakuliah/create', [MataKuliahController::class, 'create'])->name('matakuliah.create');
Route::post('/matakuliah', [MataKuliahController::class, 'store'])->name('matakuliah.store');

