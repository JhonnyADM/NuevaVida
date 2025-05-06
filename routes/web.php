<?php

use App\Http\Controllers\GestionPersonal\Personalcontroller;
use App\Http\Controllers\ProfileController;
use Faker\Provider\ar_EG\Person;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/panel', function () {
    return view('panel');
})->middleware(['auth', 'verified'])->name('panel');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('personal', Personalcontroller::class);
});

require __DIR__.'/auth.php';
