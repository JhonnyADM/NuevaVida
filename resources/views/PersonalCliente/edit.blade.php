@extends('adminlte::page')

@section('title', 'Editar ' . $cliente->personal->nombre)

@section('content_header')
    <h1>Editar Cliente </h1>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('cliente.update', $cliente->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" class="form-control" value="{{ $cliente->personal->nombre}}" required>
            </div>
            <div class="form-group">
                <label for="apellido">Apellido</label>
                <input type="text" name="apellido" class="form-control" value="{{ $cliente->personal->apellido}}" required>
            </div>
            <div class="form-group">
                <label for="celular">Celular</label>
                <input type="text" name="celular" class="form-control" value="{{ $cliente->personal->telefono}}" required>
            </div>
            <div class="form-group">
                <label for="numero_emergencia">Numero Emergencia</label>
                <input type="text" name="numero_emergencia" class="form-control" value="{{ $cliente->celular}}" required>
            </div>

            <div class="form-group">
                <label for="direccion">Direccion</label>
                <input type="text" name="direccion" class="form-control" value="{{ $cliente->direccion }}" required>
            </div>

            <button type="submit" class="btn btn-success">Actualizar</button>
            <a href="{{ route('cliente.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
@endsection
