@extends('adminlte::page')

@section('title', 'Reporte de Servicios Realizados')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="text-primary"><i class="fas fa-clipboard-list"></i> Servicios Realizados</h1>
        <button class="btn btn-outline-dark" onclick="window.print()">
            <i class="fas fa-print"></i> Imprimir
        </button>
    </div>
@endsection

@section('content')
    <div class="card">
        <div class="card-body printable-content">
            @if($servicios->count())
                <table class="table table-bordered table-striped table-sm">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Nombre del Servicio</th>
                            <th>Cantidad de veces realizado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($servicios as $index => $servicio)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $servicio->nombre }}</td>
                                <td><strong>{{ $servicio->total_realizados }}</strong></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-muted">No hay servicios registrados aún.</p>
            @endif
        </div>
    </div>
@endsection

@section('css')
<style>
    @media print {
        body * {
            visibility: hidden;
        }
        .printable-content, .printable-content * {
            visibility: visible;
        }
        .printable-content {
            position: absolute;
            left: 0;
            top: 0;
            padding: 20px;
            width: 100%;
        }
    }
</style>
@endsection
