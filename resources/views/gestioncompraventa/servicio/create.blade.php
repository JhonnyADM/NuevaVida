@extends('adminlte::page')

@section('title', 'Crear Servicio')

@section('content_header')
    <h1>Nuevo Servicio</h1>
@stop

@section('content')
    <form action="{{ route('servicio.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del Servicio</label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
            @error('nombre')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <input type="text" name="descripcion" class="form-control" value="{{ old('descripcion') }}">
            @error('descripcion')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="precio" class="form-label">Precio (Bs)</label>
            <input type="number" step="0.01" name="precio" class="form-control" value="{{ old('precio') }}" required>
            @error('precio')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <a href="{{ route('servicio.index') }}" class="btn btn-secondary">Cancelar</a>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
@stop
