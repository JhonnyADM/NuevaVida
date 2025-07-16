@extends('adminlte::page')

@section('title', 'Editar Adopción')

@section('content_header')
    <h1 class="text-warning">Editar Adopción</h1>
@stop

@section('content')
<div class="card shadow">
    <div class="card-header bg-warning text-dark">
        <strong>Formulario de Edición</strong>
    </div>
    <div class="card-body">

        <form action="{{ route('adopciones.update', $adopcion->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="cliente_id">Cliente</label>
                    <x-adminlte-select2 name="cliente_id" required>
                        @foreach($clientes as $cliente)
                            <option value="{{ $cliente->id }}" {{ $cliente->id == $adopcion->cliente_id ? 'selected' : '' }}>
                                {{ $cliente->personal->nombre }}
                            </option>
                        @endforeach
                    </x-adminlte-select2>
                </div>
                <div class="col-md-6">
                    <label for="mascota_id">Mascota</label>
                    <x-adminlte-select2 name="mascota_id" required>
                        @foreach($mascotas as $mascota)
                            <option value="{{ $mascota->id }}" {{ $mascota->id == $adopcion->mascota_id ? 'selected' : '' }}>
                                {{ $mascota->nombre }}
                            </option>
                        @endforeach
                    </x-adminlte-select2>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="fecha_adopcion">Fecha</label>
                    <x-adminlte-input name="fecha_adopcion" type="date" value="{{ $adopcion->fecha_adopcion }}" required />
                </div>
                <div class="col-md-6">
                    <label for="observaciones">Observaciones</label>
                    <x-adminlte-textarea name="observaciones" rows="2">{{ $adopcion->observaciones }}</x-adminlte-textarea>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2">
                <x-adminlte-button label="Actualizar" theme="success" icon="fas fa-sync-alt" type="submit"/>
                <a href="{{ route('adopciones.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times"></i> Cancelar
                </a>
            </div>
        </form>

    </div>
</div>
@stop
