@extends('adminlte::page')

@section('title', 'Editar Control de Internación')

@section('content_header')
    <h1>Editar Control de Internación - Mascota: {{ $mascota->nombre }}</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('mascota.internacion.control.update', [ 'mascota' => $mascota, 'tratamiento' => $tratamiento, 'control' => $control->id]) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label for="detalle">Detalles</label>
                    <textarea name="detalle" id="detalle" class="form-control @error('detalle') is-invalid @enderror" rows="4">{{ old('detalle', $control->detalle) }}</textarea>
                    @error('detalle') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="fecha">Fecha y Hora del control</label>
                    <input type="datetime-local" name="fecha" id="fecha" class="form-control @error('fecha') is-invalid @enderror"
                           value="{{ old('fecha', \Carbon\Carbon::parse($control->fecha)->format('Y-m-d\TH:i')) }}">
                    @error('fecha') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="estado_id">Estado</label>
                    <select name="estado_id" id="estado_id" class="form-control @error('estado_id') is-invalid @enderror" required>
                        <option value="">-- Seleccione un Estado --</option>
                        @foreach($estados as $estado)
                            <option value="{{ $estado->id }}" {{ old('estado_id', $control->estado_id) == $estado->id ? 'selected' : '' }}>
                                {{ $estado->descripcion }}
                            </option>
                        @endforeach
                    </select>
                    @error('estado_id') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('mascota.internacion.control.index', compact( 'mascota', 'tratamiento')) }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
