@if($mascota)
    <h4>Datos Generales</h4>
    <ul>
        <li>Raza: {{ $mascota->raza->descripcion ?? 'Sin raza' }}</li>
        <li>Color: {{ $mascota->color }}</li>
        <li>Edad: {{ $mascota->edad }}</li>
        <li>Cliente: {{ $mascota->cliente->personal->nombre ?? 'Sin nombre' }}</li>
    </ul>

    <h4>Tratamientos</h4>
    @forelse($mascota->tratamientos as $tratamiento)
        <div class="card my-2">
            <div class="card-body">
                <strong>Fecha:</strong> {{ $tratamiento->fecha }}<br>
                <strong>Tipo:</strong> {{ $tratamiento->tipoTratamiento->descripcion ?? 'N/D' }}<br>
                <strong>Veterinario:</strong> {{ $tratamiento->veterinario->personal->nombre ?? 'N/D' }}<br>
                <strong>Detalles:</strong> {{ $tratamiento->detalles }}<br>
            </div>
        </div>
    @empty
        <p>No hay tratamientos registrados.</p>
    @endforelse

    <h4>Internaciones</h4>
    @forelse($mascota->internacion as $internacion)
        <div class="card my-2">
            <div class="card-body">
                <strong>Ingreso:</strong> {{ $internacion->fecha_ingreso }}<br>
                <strong>Salida:</strong> {{ $internacion->fecha_salida }}<br>
                <strong>Veterinario:</strong> {{ $internacion->veterinario->personal->nombre ?? 'N/D' }}<br>
                <strong>Detalles:</strong> {{ $internacion->detalles }}<br>
            </div>
        </div>
    @empty
        <p>No hay internaciones registradas.</p>
    @endforelse
@else
    <p>No se encontró la mascota.</p>
@endif
