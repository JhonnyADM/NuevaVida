@extends('adminlte::page')

@section('title', 'Internaciones de Mascotas')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Internaciones de {{ $mascota->nombre }} </h1>
        <a href="{{ route('cliente.mascota.internacion.create', [$mascota->id]) }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Nueva Internacion
        </a>
    </div>
@endsection
@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Mascota</th>
                        <th>Veterinario</th>
                        <th>Ingreso</th>
                        <th>Salida</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($internaciones as $internacion)
                        <tr>
                            <td>{{ $internacion->mascota->nombre }}</td>
                            <td>{{ $internacion->veterinario->personal->nombre }}
                                {{ $internacion->veterinario->personal->apellido }}</td>
                            <td>{{ $internacion->fecha_ingreso }}</td>
                            <td>{{ $internacion->fecha_salida }}</td>
                            <td>
                                <a href="{{ route('cliente.mascota.internacion.edit', $internacion->id) }}"
                                    class="btn btn-warning btn-sm">Editar</a>

                                <form action="{{ route('cliente.mascota.internacion.destroy', $internacion->id) }}"
                                    method="POST" class="d-inline"
                                    onsubmit="return confirm('¿Estás seguro de eliminar esta internación?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                                <a href="{{ route('mascota.internacion.control.index', [
                                    'mascota' => $mascota->id,
                                    'tratamiento' => $internacion->id,
                                ]) }}"
                                    class="btn btn-secondary">
                                    <i class="fas fa-list"></i> Ver controles
                                </a>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $internaciones->links() }}
        </div>
    </div>
@endsection
