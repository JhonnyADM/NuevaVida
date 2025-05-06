@extends('adminlte::page')

@section('title', 'Editar ' . $pasante->personal->nombre)

@section('content_header')
    <h1>Editar Pasante </h1>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('pasante.update', $pasante->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" class="form-control" value="{{ $pasante->personal->nombre}}" required>
            </div>
            <div class="form-group">
                <label for="apellido">Apellido</label>
                <input type="text" name="apellido" class="form-control" value="{{ $pasante->personal->apellido}}" required>
            </div>
            <div class="form-group">
                <label for="celular">Celular</label>
                <input type="text" name="celular" class="form-control" value="{{ $pasante->personal->telefono}}" required>
            </div>
            <div class="form-group">
                <label for="inicio">Inicio</label>
                <input type="date" name="inicio" class="form-control" value="{{ $pasante->inicio}}" required>
            </div>

            <div class="form-group">
                <label for="fin">Fin</label>
                <input type="date" name="fin" class="form-control" value="{{ $pasante->fin }}" required>
            </div>
            <div class="form-group">
                <label for="estado">Estado</label>
                <select name="estado" class="form-control" required>
                    <option value="1" {{ $pasante->estado == 1 ? 'selected' : '' }}>Activo</option>
                    <option value="0" {{ $pasante->estado == 0 ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Actualizar</button>
            <a href="{{ route('pasante.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
@endsection
