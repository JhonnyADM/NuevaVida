@extends('adminlte::page')

@section('title', 'Editar ' . $voluntario->personal->nombre)

@section('content_header')
    <h1>Editar Voluntario </h1>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('voluntario.update', $voluntario->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" class="form-control" value="{{ $voluntario->personal->nombre}}" required>
            </div>
            <div class="form-group">
                <label for="apellido">Apellido</label>
                <input type="text" name="apellido" class="form-control" value="{{ $voluntario->personal->apellido}}" required>
            </div>
            <div class="form-group">
                <label for="celular">Celular</label>
                <input type="text" name="celular" class="form-control" value="{{ $voluntario->personal->telefono}}" required>
            </div>
            <div class="form-group">
                <label for="edad">Edad</label>
                <input type="number" name="edad" class="form-control" value="{{ $voluntario->edad}}" required>
            </div>

            <div class="form-group">
                <label for="direccion">Fin</label>
                <input type="text" name="direccion" class="form-control" value="{{ $voluntario->direccion }}" required>
            </div>

            <div class="form-group">
                <label for="estado">Estado</label>
                <select name="estado" class="form-control" required>
                    <option value="1" {{ $voluntario->estado == 1 ? 'selected' : '' }}>Activo</option>
                    <option value="0" {{ $voluntario->estado == 0 ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Actualizar</button>
            <a href="{{ route('voluntario.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
@endsection
