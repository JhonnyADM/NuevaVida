
@extends('adminlte::page')

@section('title', 'Notas de Ingreso')

@section('content_header')
    <h1>Notas de Ingreso</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('nota_ingreso.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Nueva Nota
            </a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Proveedor</th>
                        <th>Cantidad</th>
                        <th>Fecha</th>
                        <th>Total</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ingresos as $ingreso)
                        <tr>
                            <td>{{ $ingreso->producto->nombre }}</td>
                            <td>{{ $ingreso->provedor->descripcion }}</td>
                            <td>{{ $ingreso->cantidad }}</td>
                            <td>{{ \Carbon\Carbon::parse($ingreso->fecha)->format('d/m/Y') }}</td>
                            <td>Bs {{ number_format($ingreso->total, 2, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('nota_ingreso.edit', $ingreso) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('nota_ingreso.destroy', $ingreso) }}" method="POST" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar esta nota?')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    @if($ingresos->isEmpty())
                        <tr><td colspan="6" class="text-center">No hay notas registradas.</td></tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop
