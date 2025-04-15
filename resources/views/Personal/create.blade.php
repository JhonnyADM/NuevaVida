@extends('adminlte::page')

@section('title', 'Registro de Personal')

@section('content_header')
    <h1>Registro de Personal</h1>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('personal.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" class="form-control" placeholder="Nombre del Personal" required>
            </div>

            <div class="form-group">
                <label for="apellido">Apellido</label>
                <input type="text" name="apellido" class="form-control" placeholder="Apellido del Personal" required>
            </div>

            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="text" name="telefono" class="form-control" placeholder="Teléfono del Personal">
            </div>

            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
    </div>
</div>
@endsection
