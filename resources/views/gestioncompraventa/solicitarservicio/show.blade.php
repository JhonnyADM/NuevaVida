@extends('adminlte::page')

@section('title', 'Detalle de Atención')

@section('content_header')
    <h1>Detalle de Atención - Recibo #{{ $recibo->id }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <h5><strong>Cliente:</strong> {{ $recibo->cliente->personal->nombre ?? 'No disponible' }}</h5>
            <h5><strong>Mascota:</strong> {{ $recibo->mascota->nombre ?? 'No disponible' }}</h5>
            <h5><strong>Fecha del Recibo:</strong> {{ $recibo->fecha->format('d/m/Y') }}</h5>
            <h5><strong>Total (Bs):</strong> {{ number_format($recibo->total ?? 0, 2) }}</h5>

            @if($recibo->productos->isNotEmpty())
                <hr>
                <h5><strong>Detalle(s) de Productos:</strong></h5>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario (Bs)</th>
                            <th>Subtotal (Bs)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($recibo->productos as $producto)
                            <tr>
                                <td>{{ $producto->nombre ?? 'N/A' }}</td>
                                <td>{{ $producto->pivot->cantidad }}</td>
                                <td>{{ number_format($producto->precio ?? 0, 2) }}</td>
                                <td>{{ number_format($producto->pivot->subtotal, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

            @if($recibo->servicios->isNotEmpty())
                <hr>
                <h5><strong>Servicio(s) Asociado(s):</strong></h5>
                <ul>
                    @foreach ($recibo->servicios as $servicio)
                        <li>{{ $servicio->nombre }}</li>
                    @endforeach
                </ul>
            @endif

            <a href="{{ route('solicitar-servicio.index') }}" class="btn btn-secondary mt-3">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
        </div>
    </div>
@stop
