<?php

use App\Http\Controllers\GestionMascota\ControlController;
use App\Http\Controllers\GestionMascota\ControlInternacionController;
use App\Http\Controllers\GestionMascota\EstadoController;
use App\Http\Controllers\GestionMascota\InternacionController;
use App\Http\Controllers\GestionMascota\MascotaController;
use App\Http\Controllers\GestionMascota\RazaController;
use App\Http\Controllers\GestionMascota\TipoTratamientoController;
use App\Http\Controllers\GestionMascota\TratamientoController;
use App\Http\Controllers\GestionPersonal\AtencionController;
use App\Http\Controllers\GestionPersonal\ClienteController;
use App\Http\Controllers\GestionPersonal\EspecialidadController;
use App\Http\Controllers\GestionPersonal\MedicoController;
use App\Http\Controllers\GestionPersonal\PasanteController;
use App\Http\Controllers\GestionPersonal\Personalcontroller;
use App\Http\Controllers\GestionPersonal\VoluntarioController;
use App\Http\Controllers\GestionTareaCalficacion\TareaController;
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
    Route::get('cliente/{cliente}/mascota/{mascota}/show', [MascotaController::class, 'show'])->name('cliente.mascota.show');
    Route::put('cliente/{cliente}/mascota/{mascota}', [MascotaController::class, 'update'])->name('cliente.mascota.update');
    Route::delete('cliente/{cliente}/mascota/{mascota}', [MascotaController::class, 'destroy'])->name('cliente.mascota.destroy');

    //Route::resource('mascota', MascotaController::class)->names('mascota');
    Route::resource('raza', RazaController::class)->names('raza');
    Route::resource('especialidad', EspecialidadController::class)->names('especialidad');
    Route::resource('estado', EstadoController::class)->names('estado');
    Route::resource('tarea', TareaController::class)->names('tarea');
    Route::resource('tipotratamiento', TipoTratamientoController::class)->names('tipotratamiento');
    Route::prefix('cliente/{cliente}/mascota/{mascota}')->group(function () {
        Route::get('tratamientos', [TratamientoController::class, 'index'])->name('cliente.mascota.tratamiento.index');
        Route::get('tratamiento/create', [TratamientoController::class, 'create'])->name('cliente.mascota.tratamiento.create');
        Route::post('tratamiento', [TratamientoController::class, 'store'])->name('cliente.mascota.tratamiento.store');
        Route::get('tratamiento/{tratamiento}/edit', [TratamientoController::class, 'edit'])->name('cliente.mascota.tratamiento.edit');
        Route::put('tratamiento/{tratamiento}', [TratamientoController::class, 'update'])->name('cliente.mascota.tratamiento.update');
        Route::delete('tratamiento/{tratamiento}', [TratamientoController::class, 'destroy'])->name('cliente.mascota.tratamiento.destroy');
    });
    Route::prefix('cliente/{cliente}/mascota/{mascota}/tratamiento/{tratamiento}')->group(function () {
        Route::get('control', [ControlController::class, 'index'])->name('cliente.mascota.tratamiento.control.index');
        Route::get('control/create', [ControlController::class, 'create'])->name('cliente.mascota.tratamiento.control.create');
        Route::post('control', [ControlController::class, 'store'])->name('cliente.mascota.tratamiento.control.store');
        Route::get('control/{control}/edit', [ControlController::class, 'edit'])->name('cliente.mascota.tratamiento.control.edit');
        Route::put('control/{control}', [ControlController::class, 'update'])->name('cliente.mascota.tratamiento.control.update');
        Route::delete('control/{control}', [ControlController::class, 'destroy'])->name('cliente.mascota.tratamiento.control.destroy');
    });
    Route::prefix('cliente/mascota')->name('cliente.mascota.')->group(function () {
        Route::get('{mascota}/internacion/create', [InternacionController::class, 'create'])->name('internacion.create');
        Route::post('{mascota}/internacion', [InternacionController::class, 'store'])->name('internacion.store');
        Route::get('{mascota}internacion', [InternacionController::class, 'index'])->name('internacion.index');
        Route::get('internacion/{internacion}/edit', [InternacionController::class, 'edit'])->name('internacion.edit');
        Route::put('internacion/{internacion}', [InternacionController::class, 'update'])->name('internacion.update');
        Route::delete('internacion/{internacion}', [InternacionController::class, 'destroy'])->name('internacion.destroy');
    });
    Route::prefix('mascota/{mascota}/internacion/{tratamiento}/control')
    ->name('mascota.internacion.control.')
        ->group(function () {
            Route::get('/', [ControlInternacionController::class, 'index'])->name('index');
            Route::get('create', [ControlInternacionController::class, 'create'])->name('create');
            Route::post('/', [ControlInternacionController::class, 'store'])->name('store');
            Route::get('{control}/edit', [ControlInternacionController::class, 'edit'])->name('edit');
            Route::put('{control}', [ControlInternacionController::class, 'update'])->name('update');
            Route::delete('{control}', [ControlInternacionController::class, 'destroy'])->name('destroy');
        });
});


require __DIR__ . '/auth.php';
