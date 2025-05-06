@extends('adminlte::page')

@section('title', 'Editar ' . $medico->personal->nombre)

@section('content_header')
    <h1>Editar Personal Medico </h1>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('medico.update', $medico->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" class="form-control" value="{{ $medico->personal->nombre}}" required>
            </div>
            <div class="form-group">
                <label for="apellido">Apellido</label>
                <input type="text" name="apellido" class="form-control" value="{{ $medico->personal->apellido}}" required>
            </div>
            <div class="form-group">
                <label for="celular">Celular</label>
                <input type="text" name="celular" class="form-control" value="{{ $medico->personal->telefono}}" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" value="{{ $medico->email }}" required>
            </div>

            <div class="form-group">
                <label for="profesion">Profesion</label>
                <input type="text" name="profesion" class="form-control" value="{{ $medico->profesion }}" required>
            </div>

            <button type="submit" class="btn btn-success">Actualizar</button>
            <a href="{{ route('medico.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
@endsection
