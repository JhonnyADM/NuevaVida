@extends('adminlte::page')

@section('title', 'Seleccionar Cliente')

@section('content_header')
    <h1>Seleccionar Cliente</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Seleccionar Cliente para el reporte de Historial Clínico por Mascota</h3>
        </div>

        <form action="{{ route('reporte.historial.create') }}" method="GET">
            <div class="card-body">
                <div class="form-group">
                    <label for="cliente_id">Cliente</label>
                    <select name="cliente_id" id="cliente_id" class="form-control" required>
                        <option value="" disabled selected>-- Seleccione un cliente --</option>
                        @foreach($clientes as $cliente)
                            <option value="{{ $cliente->id }}">
                                {{ $cliente->personal->nombre ?? 'Cliente #' . $cliente->id }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Continuar</button>
            </div>
        </form>
    </div>
</div>
@stop
