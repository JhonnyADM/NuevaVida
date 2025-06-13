@extends('adminlte::page')

@section('title', 'Nueva Internación')

@section('content_header')
    <h1>Internar Mascota: <strong>{{ $mascota->nombre ?? 'Sin nombre' }}</strong></h1>
@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('cliente.mascota.internacion.store', $mascota->id) }}" method="POST">
                @csrf

                <input type="hidden" name="mascota_id" value="{{ $mascota->id }}">

                <div class="form-group">
                    <label for="detalles">Detalles de la Internación</label>
                    <textarea name="detalles" id="detalles" class="form-control @error('detalles') is-invalid @enderror" rows="3">{{ old('detalles') }}</textarea>
                    @error('detalles')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="fechaI">Fecha de Ingreso</label>
                    <input type="date" name="fecha_ingreso" id="fechaI" class="form-control @error('fecha_ingreso') is-invalid @enderror" value="{{ old('fecha_ingreso', date('Y-m-d')) }}">
                    @error('fecha_ingreso')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="fechaS">Fecha de Salida</label>
                    <input type="date" name="fecha_salida" id="fechaS" class="form-control @error('fecha_salida') is-invalid @enderror" value="{{ old('fecha_salida', date('Y-m-d')) }}">
                    @error('fecha_salida')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="veterinario_id">Veterinario Responsable</label>
                    <select name="veterinario_id" id="veterinario_id" class="form-control @error('veterinario_id') is-invalid @enderror">
                        <option value="">-- Seleccione un veterinario --</option>
                        @foreach($veterinarios as $vet)
                            <option value="{{ $vet->id }}" {{ old('veterinario_id') == $vet->id ? 'selected' : '' }}>
                                {{ $vet->personal->nombre }} {{ $vet->personal->apellido }}
                            </option>
                        @endforeach
                    </select>
                    @error('veterinario_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Guardar Internación
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
