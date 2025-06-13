@extends('adminlte::page')

@section('title', 'Editar Tratamiento')

@section('content_header')
    <h1>Editar Tratamiento</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form
                action="{{ route('cliente.mascota.tratamiento.update', ['cliente' => $clienteId, 'mascota' => $mascotaId, 'tratamiento' => $tratamiento->id]) }}"
                method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="detalles">Detalles</label>
                    <input type="text" name="detalles" class="form-control" id="detalles"
                        value="{{ old('detalles', $tratamiento->detalles) }}" required>
                    @error('detalles')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="fecha">Fecha</label>
                    <input type="date" name="fecha" class="form-control" id="fecha"
                        value="{{ old('fecha', \Carbon\Carbon::parse($tratamiento->fecha)->format('Y-m-d')) }}" required>
                    @error('fecha')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                </div>

                <div class="form-group">
                    <label for="tipo_tratamiento_id">Tipo de Tratamiento</label>
                    <select name="tipo_tratamiento_id" id="tipo_tratamiento_id" class="form-control" required>
                        <option value="">Seleccione un tipo</option>
                        @foreach ($tiposTratamiento as $tipo)
                            <option value="{{ $tipo->id }}"
                                {{ old('tipo_tratamiento_id', $tratamiento->tipo_tratamiento_id) == $tipo->id ? 'selected' : '' }}>
                                {{ $tipo->descripcion }}
                            </option>
                        @endforeach
                    </select>
                    @error('tipo_tratamiento_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Actualizar Tratamiento
                    </button>
                    <a href="{{ route('cliente.mascota.index', $clienteId) }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Volver a Mascotas
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
