<?php

use App\Http\Controllers\GestionPersonal\AtencionController;
use App\Http\Controllers\GestionPersonal\Personalcontroller;
use App\Models\GestionPersonal\Atencion;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('panel');
});
Route::resource('personal', Personalcontroller::class);
Route::resource('atencion', AtencionController::class);
