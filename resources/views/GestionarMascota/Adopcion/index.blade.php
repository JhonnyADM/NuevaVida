@extends('adminlte::page')

@section('title', 'Adopciones')

@section('content_header')
    <h1 class="text-dark">Gestión de Adopciones</h1>
@stop

@section('content')
@if (session('success'))
    <x-adminlte-alert theme="success" title="Éxito">
        {{ session('success') }}
    </x-adminlte-alert>
@endif

<div class="card shadow">
    <div class="card-header d-flex justify-content-between align-items-center">
        <strong>Listado de Adopciones</strong>
        <a href="{{ route('adopciones.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Nueva Adopción
        </a>
    </div>

    <div class="card-body table-responsive p-0">
        <table class="table table-hover table-striped table-bordered mb-0">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Cliente</th>
                    <th>Mascota</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($adopciones as $index => $adopcion)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $adopcion->cliente->personal->nombre }}</td>
                        <td>{{ $adopcion->mascota->nombre }}</td>
                        <td>{{ $adopcion->fecha_adopcion }}</td>
                        <td>
                            <a href="{{ route('adopciones.edit', $adopcion->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>

                            <form action="{{ route('adopciones.destroy', $adopcion->id) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('¿Estás seguro de eliminar esta adopción?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No hay adopciones registradas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@stop
