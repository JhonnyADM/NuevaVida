<?php

use App\Http\Controllers\GestionCompraVenta\CategoriaController;
use App\Http\Controllers\GestionCompraVenta\NotaIngresoController;
use App\Http\Controllers\GestionCompraVenta\ProductoController;
use App\Http\Controllers\GestionCompraVenta\PromocionController;
use App\Http\Controllers\GestionCompraVenta\ProvedorController;
use App\Http\Controllers\GestionCompraVenta\ServicioController;
use App\Http\Controllers\GestionCompraVenta\SolicitarServicioController;
use App\Http\Controllers\GestionMascota\AdopcionController;
use App\Http\Controllers\GestionMascota\ControlController;
use App\Http\Controllers\GestionMascota\ControlInternacionController;
use App\Http\Controllers\GestionMascota\EstadoController;
use App\Http\Controllers\GestionMascota\InternacionController;
use App\Http\Controllers\GestionMascota\MascotaController;
use App\Http\Controllers\GestionMascota\RazaController;
use App\Http\Controllers\GestionMascota\TipoTratamientoController;
use App\Http\Controllers\GestionMascota\TratamientoController;
use App\Http\Controllers\GestionPersonal\AreaController;
use App\Http\Controllers\GestionPersonal\AreaPersonalTurnoController;
use App\Http\Controllers\GestionPersonal\AtencionController;
use App\Http\Controllers\GestionPersonal\ClienteController;
use App\Http\Controllers\GestionPersonal\EspecialidadController;
use App\Http\Controllers\GestionPersonal\MedicoController;
use App\Http\Controllers\GestionPersonal\PasanteController;
use App\Http\Controllers\GestionPersonal\Personalcontroller;
use App\Http\Controllers\GestionPersonal\TurnoController;
use App\Http\Controllers\GestionPersonal\VoluntarioController;
use App\Http\Controllers\GestionReportes\ReporteCalificacionController;
use App\Http\Controllers\GestionReportes\ReporteHistorialClinicoController;
use App\Http\Controllers\GestionReportes\ReporteProductosVencidosController;
use App\Http\Controllers\GestionReportes\ReporteServicioRealizadosController;
use App\Http\Controllers\GestionTareaCalficacion\AsignacionTareaController;
use App\Http\Controllers\GestionTareaCalficacion\CalificacionController;
use App\Http\Controllers\GestionTareacalficacion\CalificacionPersonalController;
use App\Http\Controllers\GestionTareaCalficacion\TareaController;
use App\Http\Controllers\GestionUsuario\RolPermisoController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\VerificarRol;
use App\Models\GestionCompraVenta\Servicio;
use App\Models\GestionPersonal\Atencion;
use Faker\Provider\ar_EG\Person;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Attributes\Group;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/panel', [PanelController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('panel');
Route::middleware('auth')->group(function () {

    Route::post('calificaciones', [CalificacionPersonalController::class, 'store'])->name('calificaciones.store');

    //roles y permisos
    Route::middleware([VerificarRol::class . ':superadmin'])->group(function () {
        Route::prefix('roles')->name('roles.')->group(function () {
            Route::get('/', [RolPermisoController::class, 'index'])->name('index');
            Route::get('{role}/permisos/edit', [RolPermisoController::class, 'editPermissions'])->name('permissions.edit');
            Route::post('{role}/permisos/update', [RolPermisoController::class, 'updatePermissions'])->name('permissions.update');
        });
    });



    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware([VerificarRol::class . ':superadmin|atencion'])->group(function () {

        /**calificaiones de personal  */
         Route::get('calificaciones', [CalificacionPersonalController::class, 'index'])->name('calificaciones.index');
        Route::get('calificaciones/{id}', [CalificacionPersonalController::class, 'show'])->name('calificaciones.show');
        Route::delete('calificaciones/{id}', [CalificacionPersonalController::class, 'destroy'])->name('calificaciones.destroy');
        // Gestión de todo el personal general
        Route::resource('personal', Personalcontroller::class);
        // Subgrupo para tipos específicos de personal

        Route::resource('atencion', AtencionController::class)->names('atencion');
        Route::resource('medico', MedicoController::class)->names('medico');
        Route::resource('pasante', PasanteController::class)->names('pasante');
        Route::resource('voluntario', VoluntarioController::class)->names('voluntario');

        Route::resource('raza', RazaController::class)->names('raza');
        Route::resource('especialidad', EspecialidadController::class)->names('especialidad');
        Route::resource('estado', EstadoController::class)->names('estado');
        Route::resource('tarea', TareaController::class)->names('tarea');


        Route::resource('provedor', ProvedorController::class)->names('provedor');
        Route::resource('categoria', CategoriaController::class)->names('categoria');
        Route::resource('producto', ProductoController::class)->names('producto');
        Route::resource('nota_ingreso', NotaIngresoController::class)->names('nota_ingreso');
        Route::resource('servicio', ServicioController::class)->names('servicio');
        /**promocion */
        Route::resource('promociones', PromocionController::class)->names('promociones');
        Route::prefix('solicitar-servicio')->group(function () {
            // Vista para seleccionar cliente
            Route::get('/seleccionar-cliente', [SolicitarServicioController::class, 'solicitarServicio'])
                ->name('solicitar-servicio.seleccionar-cliente');

            // Vista para crear una solicitud ya con el cliente seleccionado
            Route::get('/crear', [SolicitarServicioController::class, 'create'])
                ->name('solicitar-servicio.create');

            // Ruta que procesa el formulario y guarda la solicitud
            Route::post('/', [SolicitarServicioController::class, 'store'])
                ->name('solicitar-servicio.store');

            // Listar atenciones ya registradas
            Route::get('/', [SolicitarServicioController::class, 'index'])
                ->name('solicitar-servicio.index');

            // Ver detalle de una solicitud
            Route::get('/{id}', [SolicitarServicioController::class, 'show'])
                ->name('solicitar-servicio.show');

            // Eliminar solicitud
            Route::delete('/{id}', [SolicitarServicioController::class, 'destroy'])
                ->name('solicitar-servicio.destroy');
            // Editar solicitud
            Route::get('/{id}/edit', [SolicitarServicioController::class, 'edit'])->name('solicitar-servicio.edit');
            Route::put('/{id}', [SolicitarServicioController::class, 'update'])->name('solicitar-servicio.update');
        });

        /**Gestion areas */
        Route::resource('area', AreaController::class)->names('area');
        /**Gestion turnos */
        Route::resource('turno', TurnoController::class)->names('turno');
        /**Asignaciones de personal a areas y turnos */
        Route::resource('asignacionesturnos', AreaPersonalTurnoController::class)
            ->parameters(['asignacionesturnos' => 'asignacione']);
    });


    Route::middleware([VerificarRol::class . ':superadmin|veterinario'])->group(function () {
        /** Adopciones */
        Route::resource('adopciones', AdopcionController::class);

        Route::resource('cliente', ClienteController::class)->names('cliente');
        Route::resource('tipotratamiento', TipoTratamientoController::class)->names('tipotratamiento');
        // Mascotas del cliente
        // Crear mascota para un cliente específico
        Route::get('mascota/create', [MascotaController::class, 'crear'])->name('mascota.crear');
        Route::post('mascota', [MascotaController::class, 'validar'])->name('mascota.validar');
        Route::get('mascotas', [MascotaController::class, 'mostrar'])->name('mascota.mostrar');
        Route::get('mascota/{mascota}/edit', [MascotaController::class, 'editar'])->name('mascota.editar');
        Route::get('mascota/{mascota}/show', [MascotaController::class, 'ver'])->name('mascota.ver');
        Route::put('mascota/{mascota}', [MascotaController::class, 'actualizar'])->name('mascota.actualizar');
        Route::delete('mascota/{mascota}', [MascotaController::class, 'eliminar'])->name('mascota.eliminar');
        /**mascotas con clientes */
        Route::put('cliente/{cliente}/mascota/{mascota}', [MascotaController::class, 'update'])->name('cliente.mascota.update');
        Route::delete('cliente/{cliente}/mascota/{mascota}', [MascotaController::class, 'destroy'])->name('cliente.mascota.destroy');
        Route::get('cliente/{cliente}/mascota/create', [MascotaController::class, 'create'])->name('cliente.mascota.create');
        Route::post('cliente/{cliente}/mascota', [MascotaController::class, 'store'])->name('cliente.mascota.store');
        Route::get('cliente/{cliente}/mascotas', [MascotaController::class, 'index'])->name('cliente.mascota.index');
        Route::get('cliente/{cliente}/mascota/{mascota}/edit', [MascotaController::class, 'edit'])->name('cliente.mascota.edit');
        Route::get('cliente/{cliente}/mascota/{mascota}/show', [MascotaController::class, 'show'])->name('cliente.mascota.show');
        Route::put('cliente/{cliente}/mascota/{mascota}', [MascotaController::class, 'update'])->name('cliente.mascota.update');
        Route::delete('cliente/{cliente}/mascota/{mascota}', [MascotaController::class, 'destroy'])->name('cliente.mascota.destroy');


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
    Route::post('calificacion', [CalificacionController::class, 'store'])->name('calificacion.store');
    Route::get('/reporte/calificaciones', [ReporteCalificacionController::class, 'index'])
        ->middleware(['auth'])
        ->name('reporte.calificaciones');
});
Route::get('/reporte/servicios-realizados', [ReporteServicioRealizadosController::class, 'index'])
    ->middleware(['auth'])
    ->name('reporte.servicios-realizados');


Route::get('/reporte/productos-vencidos', [ReporteProductosVencidosController::class, 'general'])
    ->middleware(['auth'])
    ->name('reporte.productos.vencidos.general');

Route::get('/reporte/productos-vencidos/categoria', [ReporteProductosVencidosController::class, 'porCategoria'])
    ->middleware(['auth'])
    ->name('reporte.productos.vencidos.categoria');

Route::get('/reporte/historial-clinico/seleccionar-cliente', [ReporteHistorialClinicoController::class, 'seleccionarCliente'])
    ->name('reporte.historial.seleccionar-cliente');

// Procesamiento del cliente seleccionado: muestra sus mascotas
Route::get('/reporte/historial-clinico', [ReporteHistorialClinicoController::class, 'create'])
    ->name('reporte.historial.create');

// Carga dinámica del historial clínico de una mascota (AJAX)
Route::get('/reporte/historial-clinico/ajax/{mascota_id}', [ReporteHistorialClinicoController::class, 'ajax'])
    ->name('reporte.historial.ajax');

// Vista directa del historial clínico completo de una mascota (opcional si se usa sin AJAX)
Route::get('/reporte/historial-clinico/mascota/{mascota_id}', [ReporteHistorialClinicoController::class, 'show'])
    ->name('reporte.historial.show');
// Ruta 'dashboard' para evitar errores de redirección


Route::get('/asignar-tarea', [AsignacionTareaController::class, 'create'])->name('asignaciones.create');
Route::post('/asignar-tarea', [AsignacionTareaController::class, 'store'])->name('asignaciones.store');
Route::get('/asignaciones/pasantes', [AsignacionTareaController::class, 'tareasPorPasante'])->name('asignaciones.pasantes');
Route::get('/asignaciones/voluntarios', [AsignacionTareaController::class, 'tareasPorVoluntario'])->name('asignaciones.voluntarios');

require __DIR__ . '/auth.php';
