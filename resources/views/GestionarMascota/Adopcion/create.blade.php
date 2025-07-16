@extends('adminlte::page')

@section('title', 'Nueva Adopción')

@section('content_header')
    <h1 class="text-primary">Registrar Nueva Adopción</h1>
@stop

@section('content')
<div class="card shadow">
    <div class="card-header bg-primary text-white">
        <strong>Formulario de Adopción</strong>
    </div>
    <div class="card-body">

        <form action="{{ route('adopciones.store') }}" method="POST">
            @csrf

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="cliente_id" class="form-label">Cliente que adopta</label>
                    <x-adminlte-select2 name="cliente_id" required>
                        <option value="">Seleccione un cliente</option>
                        @foreach($clientes as $cliente)
                            <option value="{{ $cliente->id }}">{{ $cliente->personal->nombre }}</option>
                        @endforeach
                    </x-adminlte-select2>
                </div>
                <div class="col-md-6">
                    <label for="mascota_id" class="form-label">Mascota disponible</label>
                    <x-adminlte-select2 name="mascota_id" required>
                        <option value="">Seleccione una mascota</option>
                        @foreach($mascotas as $mascota)
                            <option value="{{ $mascota->id }}">{{ $mascota->nombre }} - {{ $mascota->descripcion }}</option>
                        @endforeach
                    </x-adminlte-select2>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="fecha_adopcion" class="form-label">Fecha de adopción</label>
                    <x-adminlte-input name="fecha_adopcion" type="date" value="{{ date('Y-m-d') }}" required />
                </div>
                <div class="col-md-6">
                    <label for="observaciones" class="form-label">Observaciones</label>
                    <x-adminlte-textarea name="observaciones" rows="2" placeholder="Observaciones opcionales..." />
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2">
                <x-adminlte-button label="Guardar" theme="primary" icon="fas fa-save" type="submit"/>
                <a href="{{ route('adopciones.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Cancelar
                </a>
            </div>
        </form>

    </div>
</div>
@stop
