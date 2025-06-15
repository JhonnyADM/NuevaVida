@extends('adminlte::page')

@section('title', 'Seleccionar Cliente')

@section('content_header')
    <h1>Seleccionar Cliente</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Seleccionar Cliente para Solicitud de Servicio</h3>
        </div>
        <!-- /.card-header -->

        <form action="{{ route('solicitar-servicio.create') }}" method="GET">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="cliente_id">Cliente</label>
                    <select name="cliente_id" id="cliente_id" class="form-control" required>
                        <option value="" disabled selected>-- Seleccione un cliente --</option>
                        @foreach($clientes->get() as $cliente)
                            <option value="{{ $cliente->id }}">{{ $cliente->personal->nombre ?? 'Cliente #' . $cliente->id }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="atencion_id">Personal de Atencion</label>
                    <select name="atencion_id" id="atencion_id" class="form-control" required>
                        <option value="" disabled selected>-- Seleccione un personal de Atencion --</option>
                        @foreach($atencion->get() as $aten)
                            <option value="{{ $aten->id }}">{{ $aten->personal->nombre ?? 'Atencion #' . $aten->id }}</option>
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
