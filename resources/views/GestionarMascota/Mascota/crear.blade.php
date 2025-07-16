@extends('adminlte::page')

@section('title', 'Registrar Mascota')

@section('content_header')
    <h1>Registrar Nueva Mascota</h1>
@endsection

@section('content')
    <form action="{{ route('mascota.validar') }}" method="POST">
        @csrf

        @include('GestionarMascota.Mascota.form')

        <button class="btn btn-primary">Guardar Mascota</button>
        <a href="{{ route('mascota.mostrar') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection
