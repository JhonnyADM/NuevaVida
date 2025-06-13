@extends('adminlte::page')

@section('title', 'Detalle de Nota de Ingreso')

@section('content_header')
    <h1>Detalle de Nota de Ingreso</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <strong>Producto:</strong>
                <p>{{ $nota_ingreso->producto->nombre }}</p>
            </div>

            <div class="mb-3">
                <strong>Proveedor:</strong>
                <p>{{ $nota_ingreso->provedor->descripcion }}</p>
            </div>

            <div class="mb-3">
                <strong>Cantidad:</strong>
                <p>{{ $nota_ingreso->cantidad }}</p>
            </div>

            <div class="mb-3">
                <strong>Fecha:</strong>
                <p>{{ \Carbon\Carbon::parse($nota_ingreso->fecha)->format('d/m/Y') }}</p>
            </div>

            <div class="mb-3">
                <strong>Total:</strong>
                <p>Bs {{ number_format($nota_ingreso->total, 2, ',', '.') }}</p>
            </div>

            <a href="{{ route('nota_ingreso.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver
            </a>

            <a href="{{ route('nota_ingreso.edit', $nota_ingreso) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Editar
            </a>

            <form action="{{ route('nota_ingreso.destroy', $nota_ingreso) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" onclick="return confirm('¿Deseas eliminar esta nota de ingreso?')">
                    <i class="fas fa-trash-alt"></i> Eliminar
                </button>
            </form>
        </div>
    </div>
@stop
