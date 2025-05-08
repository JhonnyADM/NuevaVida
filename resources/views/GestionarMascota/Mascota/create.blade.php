@extends('adminlte::page')

@section('title', 'Registrar Mascota')

@section('content_header')
    <h1>Registrar Nueva Mascota</h1>
@endsection

@section('content')
    <form action="{{ route('cliente.mascota.store', $cliente->id) }}" method="POST">
        @csrf

        @include('gestionarmascota.mascota.form')

        <button class="btn btn-primary">Guardar Mascota</button>
        <a href="{{ route('cliente.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection
