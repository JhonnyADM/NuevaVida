@extends('adminlte::page')

@section('title', 'Tratamientos de ')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Tratamientos de {{ $mascota->nombre }} </h1>
        <a href="{{ route('cliente.mascota.tratamiento.create', [$cliente->id, $mascota->id]) }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Nuevo Tratamiento
        </a>
    </div>
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Detalles</th>
                <th>Fecha</th>
                <th>Tipo de Tratamiento</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tratamientos as $tratamiento)
                <tr>
                    <td>{{ $tratamiento->detalles }}</td>
                    <td>{{ \Carbon\Carbon::parse($tratamiento->fecha)->format('d/m/Y') }}</td>
                    <td>{{ $tratamiento->tipoTratamiento->descripcion ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ route('cliente.mascota.tratamiento.edit', [$cliente->id, $mascota->id, $tratamiento->id]) }}"
                            class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <form
                            action="{{ route('cliente.mascota.tratamiento.destroy', [$cliente->id, $mascota->id, $tratamiento->id]) }}"
                            method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('¿Eliminar este tratamiento?')"
                                class="btn btn-danger btn-sm">
                                <i class="fas fa-trash-alt"></i> Eliminar
                            </button>
                        </form>
                        <a href="{{ route('cliente.mascota.tratamiento.control.create', [$cliente->id, $mascota->id, $tratamiento->id]) }}"
                            class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Agregar Control a Tratamiento
                        </a>
                        <a href="{{ route('cliente.mascota.tratamiento.control.index', [$cliente->id, $mascota->id, $tratamiento->id]) }}"
                            class="btn btn-sm btn-info">
                            <i class="fas fa-list"></i> Ver Controles
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">No hay tratamientos registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $tratamientos->links() }}
@endsection
