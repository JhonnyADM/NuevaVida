@extends('adminlte::page')

@section('title', 'Servicios')

@section('content_header')
    <h1>Listado de Servicios</h1>
@stop

@section('content')
    <a href="{{ route('servicio.create') }}" class="btn btn-success mb-3">Agregar Servicio</a>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>¡Éxito!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    @endif


    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio (Bs)</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($servicios as $servicio)
                <tr>
                    <td>{{ $servicio->id }}</td>
                    <td>{{ $servicio->nombre }}</td>
                    <td>{{ $servicio->descripcion }}</td>
                    <td>{{ number_format($servicio->precio, 2) }}</td>
                    <td>
                        <a href="{{ route('servicio.edit', $servicio) }}" class="btn btn-sm btn-info">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <form action="{{ route('servicio.destroy', $servicio) }}" method="POST"
                            style="display:inline-block;"
                            onsubmit="return confirm('¿Está seguro de eliminar este servicio?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i> Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop
