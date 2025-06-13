@extends('adminlte::page')

@section('title', 'Agregar Tratamiento')

@section('content_header')
    <h1>Agregar Tratamiento para Mascota: {{ $mascota->nombre ?? 'Sin nombre' }}</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
           <form action="{{ route('cliente.mascota.tratamiento.store', ['cliente' => $cliente->id, 'mascota' => $mascota->id]) }}" method="POST">
                @csrf

                <input type="hidden" name="mascota_id" value="{{ $mascota->id }}">

                <div class="form-group mb-3">
                    <label for="detalles">Detalles</label>
                    <textarea name="detalles" id="detalles" class="form-control @error('detalles') is-invalid @enderror" rows="4" placeholder="Describa el tratamiento...">{{ old('detalles') }}</textarea>
                    @error('detalles')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="fecha">Fecha</label>
                    <input type="date" name="fecha" id="fecha" class="form-control @error('fecha') is-invalid @enderror" value="{{ old('fecha', date('Y-m-d')) }}">
                    @error('fecha')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="tipo_tratamiento_id">Tipo de Tratamiento</label>
                    <select name="tipo_tratamiento_id" id="tipo_tratamiento_id" class="form-control @error('tipo_tratamiento_id') is-invalid @enderror" required>
                        <option value="">-- Seleccione un tipo --</option>
                        @foreach($tiposTratamiento as $tipo)
                            <option value="{{ $tipo->id }}" {{ old('tipo_tratamiento_id') == $tipo->id ? 'selected' : '' }}>
                                {{ $tipo->descripcion }}
                            </option>
                        @endforeach
                    </select>
                    @error('tipo_tratamiento_id')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="veterinario_id">Veterinario</label>
                    <select name="veterinario_id" id="veterinario_id" class="form-control @error('veterinario_id') is-invalid @enderror" required>
                        <option value="">-- Seleccione un veterinario --</option>
                        @foreach($veterinarios as $vet)
                            <option value="{{ $vet->id }}" {{ old('veterinario_id') == $vet->id ? 'selected' : '' }}>
                                {{ $vet->personal->nombre ?? '' }} {{ $vet->personal->apellido ?? '' }}
                            </option>
                        @endforeach
                    </select>
                    @error('veterinario_id')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Guardar Tratamiento
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
