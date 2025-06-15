@extends('adminlte::page')

@section('title', 'Editar Servicio')

@section('content_header')
    <h1>Editar Servicio</h1>
@stop

@section('content')
    <form action="{{ route('servicio.update', $servicio) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $servicio->nombre) }}" required>
            @error('nombre')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <input type="text" name="descripcion" class="form-control" value="{{ old('descripcion', $servicio->descripcion) }}">
            @error('descripcion')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="precio" class="form-label">Precio</label>
            <input type="number" step="0.01" name="precio" class="form-control" value="{{ old('precio', $servicio->precio) }}" required>
            @error('precio')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <a href="{{ route('servicio.index') }}" class="btn btn-secondary">Cancelar</a>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
@stop
