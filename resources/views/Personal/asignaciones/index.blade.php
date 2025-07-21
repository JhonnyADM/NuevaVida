@extends('adminlte::page')

@section('title', 'Asignaciones de Turno')

@section('content_header')
    <h1 class="mb-3">Asignaciones de Turno por Área</h1>
@endsection

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h3 class="card-title">Lista de Asignaciones</h3>
        <a href="{{ route('asignacionesturnos.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nueva Asignación
        </a>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th>Personal</th>
                    <th>Área</th>
                    <th>Turno</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            @foreach($asignaciones as $asignacion)
                <tr>
                    <td>
                        {{ $asignacion->personal->nombre }}

                        @if ($asignacion->personal->atencion)
                            <span class="badge bg-info ml-1">Atención</span>
                        @endif

                        @if ($asignacion->personal->veterinario)
                            <span class="badge bg-success ml-1">Veterinario</span>
                        @endif
                    </td>
                    <td>{{ $asignacion->area->nombre }}</td>
                    <td>
                        {{ $asignacion->turno->nombre }}<br>
                        <small class="text-muted">{{ $asignacion->turno->hora_inicio->format('H:i') }} - {{ $asignacion->turno->hora_fin->format('H:i') }}</small>
                    </td>
                    <td>
                        <a href="{{ route('asignacionesturnos.edit', $asignacion) }}" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('asignacionesturnos.destroy', $asignacion) }}" method="POST" class="d-inline-block" onsubmit="return confirm('¿Está seguro de eliminar esta asignación?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
