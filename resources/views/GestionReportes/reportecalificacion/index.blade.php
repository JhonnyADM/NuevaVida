@extends('adminlte::page')

@section('title', 'Reporte de Calificaciones')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="text-primary"><i class="fas fa-star-half-alt"></i> Calificaciones por Servicio</h1>
        <button class="btn btn-outline-dark" onclick="imprimirTodo()">
            <i class="fas fa-print"></i> Imprimir Reporte
        </button>
    </div>
@endsection

@section('content')
<div class="card">
    <div class="card-body printable-content">
        @foreach ($servicios as $servicio)
            @php
                $total = $servicio->calificaciones->count();
                $promedio = $total > 0 ? round($servicio->calificaciones->avg('valor'), 2) : 0;
            @endphp

            <div class="mb-5 pb-3 border-bottom">
                <h4 class="text-success mb-1">
                    <i class="fas fa-stethoscope"></i> {{ $servicio->nombre }}
                </h4>

                <p>
                    <strong>Total de calificaciones:</strong> {{ $total }}<br>
                    <strong>Promedio:</strong>
                    <span class="text-warning">
                        @for ($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star{{ $i <= $promedio ? '' : '-o' }}"></i>
                        @endfor
                    </span>
                    ({{ $promedio }} / 5)
                </p>

                @if ($total > 0)
                    <table class="table table-bordered table-sm mt-2">
                        <thead class="thead-light">
                            <tr>
                                <th style="width: 25%">Cliente</th>
                                <th style="width: 15%">Calificación</th>
                                <th style="width: 40%">Comentario</th>
                                <th style="width: 20%">Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($servicio->calificaciones as $calificacion)
                                <tr>
                                    <td>{{ optional($calificacion->cliente->personal)->nombre ?? 'Cliente desconocido' }}</td>
                                    <td>
                                        <span class="text-warning">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star{{ $i <= $calificacion->valor ? '' : '-o' }}"></i>
                                            @endfor
                                        </span>
                                        ({{ $calificacion->valor }})
                                    </td>
                                    <td>{{ $calificacion->comentario ?? '-' }}</td>
                                    <td>{{ $calificacion->created_at->format('d/m/Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-muted">No hay calificaciones registradas.</p>
                @endif
            </div>
        @endforeach
    </div>
</div>
@endsection

@section('css')
<style>
    .fa-star, .fa-star-o {
        color: #f8b400;
    }

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

@section('js')
<script>
    function imprimirTodo() {
        window.print();
    }
</script>
@endsection
