<?php

use App\Http\Controllers\GestionPersonal\AtencionController;
use App\Http\Controllers\GestionPersonal\MedicoController;
use App\Http\Controllers\GestionPersonal\PasanteController;
use App\Http\Controllers\GestionPersonal\Personalcontroller;
use App\Http\Controllers\ProfileController;
use App\Models\GestionPersonal\Atencion;
use Faker\Provider\ar_EG\Person;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/panel', function () {
    return view('panel');
})->middleware(['auth', 'verified'])->name('panel');

Route::middleware('auth')->group(function () {
    // Perfil del usuario autenticado
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Gestión de todo el personal general
    Route::resource('personal', Personalcontroller::class);

    // Subgrupo para tipos específicos de personal

        Route::resource('atencion', AtencionController::class)->names('atencion');
        Route::resource('medico', MedicoController::class)->names('medico');
        Route::resource('pasante', PasanteController::class)->names('pasante');
        /*Route::resource('voluntario', VoluntarioController::class);
        Route::resource('cliente', ClienteController::class);

        // Mascotas del cliente
        Route::resource('cliente/mascotas', MascotaController::class);*/

});


require __DIR__.'/auth.php';
