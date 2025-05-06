@extends('adminlte::page')

@section('title', 'Editar ' . $atencion->personal->nombre)

@section('content_header')
    <h1>Editar Personal Atencion </h1>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('atencion.update', $atencion->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" class="form-control" value="{{ $atencion->personal->nombre}}" required>
            </div>
            <div class="form-group">
                <label for="apellido">Apellido</label>
                <input type="text" name="apellido" class="form-control" value="{{ $atencion->personal->apellido}}" required>
            </div>
            <div class="form-group">
                <label for="celular">Celular</label>
                <input type="text" name="celular" class="form-control" value="{{ $atencion->personal->telefono}}" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" value="{{ $atencion->email }}" required>
            </div>

            <div class="form-group">
                <label for="cargo">Cargo</label>
                <input type="text" name="cargo" class="form-control" value="{{ $atencion->cargo }}" required>
            </div>

            <button type="submit" class="btn btn-success">Actualizar</button>
            <a href="{{ route('atencion.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
@endsection
