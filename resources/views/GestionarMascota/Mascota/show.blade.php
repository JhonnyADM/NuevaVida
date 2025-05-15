@extends('adminlte::page')
@section('title', 'Detalles de la Mascota')
@section('content_header')
    <h1>Detalles de la Mascota</h1>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Nombre: {{ $mascota->nombre }}</h5>
            <p class="card-text"><strong>Raza:</strong> {{ $mascota->raza->descripcion }}</p>
            <p class="card-text"><strong>Edad:</strong> {{ $mascota->edad }}</p>
            <p class="card-text"><strong>Peso:</strong> {{ $mascota->peso }}</p>
            <p class="card-text"><strong>Color:</strong> {{ $mascota->color }}</p>
            <p class="card-text"><strong>Dueño:</strong> {{ $mascota->cliente->personal->nombre }} {{ $mascota->cliente->personal->apellido }}</p>
            <p class="card-text"><strong>Teléfono del dueño:</strong> {{ $mascota->cliente->personal->telefono }}</p>
            <p class="card-text"><strong>Descripción:</strong> {{ $mascota->descripcion }}</p>
            <p class="card-text"><strong>Fecha de creación:</strong> {{ $mascota->created_at }}</p>
            <p class="card-text"><strong>Fecha de actualización:</strong> {{ $mascota->updated_at }}</p>

        </div>
    </div>
@endsection

