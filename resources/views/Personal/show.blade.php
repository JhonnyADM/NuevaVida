@extends('adminlte::page')

@section('content')
<div class="container">
    <h2>Detalle del Personal</h2>

    <div class="card mb-3">
        <div class="card-body">
            <p><strong>Nombre:</strong> {{ $personal->nombre }}</p>
            <p><strong>Apellido:</strong> {{ $personal->apellido }}</p>
            <p><strong>Teléfono:</strong> {{ $personal->telefono }}</p>
            <p><strong>Tipo:</strong> {{ ucfirst($personal->tipo) }}</p>
        </div>
    </div>

    @if($detalle)
        <div class="card">
            <div class="card-header">
                <strong>Datos adicionales ({{ ucfirst($personal->tipo) }})</strong>
            </div>
            <div class="card-body">
                @if($personal->tipo === 'cliente')
                    <p><strong>Celular:</strong> {{ $detalle->celular }}</p>
                    <p><strong>Dirección:</strong> {{ $detalle->direccion }}</p>
                @elseif($personal->tipo === 'pasante')
                    <p><strong>Inicio:</strong> {{ $detalle->inicio }}</p>
                    <p><strong>Fin:</strong> {{ $detalle->fin }}</p>
                    <p><strong>Estado:</strong> {{ $detalle->estado ? 'Activo' : 'Inactivo' }}</p>
                @elseif($personal->tipo === 'atencion')
                    <p><strong>Cargo:</strong> {{ $detalle->cargo }}</p>
                    <p><strong>Email:</strong> {{ $detalle->email }}</p>
                @elseif($personal->tipo === 'voluntario')
                    <p><strong>Dirección:</strong> {{ $detalle->direccion }}</p>
                    <p><strong>Edad:</strong> {{ $detalle->edad }}</p>
                    <p><strong>Estado:</strong> {{ $detalle->estado ? 'Activo' : 'Inactivo' }}</p>
                @elseif($personal->tipo === 'veterinario')
                    <p><strong>Profesión:</strong> {{ $detalle->profesion }}</p>
                    <p><strong>Email:</strong> {{ $detalle->email }}</p>
                @endif
            </div>
        </div>
    @else
        <div class="alert alert-warning mt-3">No se encontraron datos adicionales para este tipo.</div>
    @endif

    <a href="{{ route('personal.index') }}" class="btn btn-secondary mt-3">Volver</a>
</div>
@endsection
