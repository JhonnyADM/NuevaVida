<?php

use App\Http\Controllers\GestionMascota\MascotaController;
use App\Http\Controllers\GestionMascota\RazaController;
use App\Http\Controllers\GestionPersonal\AtencionController;
use App\Http\Controllers\GestionPersonal\ClienteController;
use App\Http\Controllers\GestionPersonal\MedicoController;
use App\Http\Controllers\GestionPersonal\PasanteController;
use App\Http\Controllers\GestionPersonal\Personalcontroller;
use App\Http\Controllers\GestionPersonal\VoluntarioController;
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
    Route::resource('voluntario', VoluntarioController::class)->names('voluntario');
    Route::resource('cliente', ClienteController::class)->names('cliente');

    // Mascotas del cliente
    // Crear mascota para un cliente específico
    Route::get('cliente/{cliente}/mascota/create', [MascotaController::class, 'create'])->name('cliente.mascota.create');
    Route::post('cliente/{cliente}/mascota', [MascotaController::class, 'store'])->name('cliente.mascota.store');
    Route::get('cliente/{cliente}/mascotas', [MascotaController::class, 'index'])->name('cliente.mascota.index');
    Route::get('cliente/{cliente}/mascota/{mascota}/edit', [MascotaController::class, 'edit'])->name('cliente.mascota.edit');
    Route::put('cliente/{cliente}/mascota/{mascota}', [MascotaController::class, 'update'])->name('cliente.mascota.update');
    Route::delete('cliente/{cliente}/mascota/{mascota}', [MascotaController::class, 'destroy'])->name('cliente.mascota.destroy');

    //Route::resource('mascota', MascotaController::class)->names('mascota');
    Route::resource('raza', RazaController::class)->names('raza');
});


require __DIR__ . '/auth.php';
