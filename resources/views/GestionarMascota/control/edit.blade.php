@extends('adminlte::page')

@section('title', 'Editar Control de Tratamiento')

@section('content_header')
    <h1>Editar Control de Tratamiento para Mascota: {{ $mascota->nombre ?? 'Sin nombre' }}</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('cliente.mascota.tratamiento.control.update', [
                'cliente' => $cliente->id,
                'mascota' => $mascota->id,
                'tratamiento' => $tratamiento->id,
                'control' => $control->id
            ]) }}" method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" name="tratamiento_id" value="{{ $tratamiento->id }}">

                <div class="form-group mb-3">
                    <label for="observacion">Observaciones</label>
                    <textarea name="observacion" id="observacion" class="form-control @error('observacion') is-invalid @enderror" rows="4" placeholder="Describa la Observación...">{{ old('observacion', $control->Observacion) }}</textarea>
                    @error('observacion')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="fecha">Fecha del Control</label>
                    <input type="date" name="fecha" id="fecha" class="form-control @error('fecha') is-invalid @enderror" value="{{ old('fecha', \Carbon\Carbon::parse($control->fecha)->format('Y-m-d')) }}"
>
                    @error('fecha')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
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
                    @error('estado_id')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Actualizar Control de Tratamiento
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
