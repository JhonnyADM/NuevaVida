@extends('adminlte::page')

@section('title', 'Editar Internación')

@section('content_header')
    <h1>Editar Internación para Mascota: {{ $internacion->mascota->nombre }}</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('cliente.mascota.internacion.update', $internacion->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label for="detalles">Detalles</label>
                    <textarea name="detalles" id="detalles" class="form-control @error('detalles') is-invalid @enderror" rows="4">{{ old('detalles', $internacion->detalles) }}</textarea>
                    @error('detalles')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="fechaI">Fecha Ingreso</label>
                    <input type="date" name="fecha_ingreso" id="fechaI" class="form-control @error('fecha_ingreso') is-invalid @enderror" value="{{ old('fecha_ingreso', $internacion->fecha_ingreso) }}">
                    @error('fecha_ingreso')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="fechaS">Fecha Salida</label>
                    <input type="date" name="fecha_salida" id="fechaS" class="form-control @error('fecha_salida') is-invalid @enderror" value="{{ old('fecha_salida', $internacion->fecha_salida) }}">
                    @error('fecha_salida')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="veterinario_id">Veterinario</label>
                    <select name="veterinario_id" id="veterinario_id" class="form-control @error('veterinario_id') is-invalid @enderror">
                        @foreach($veterinarios as $vet)
                            <option value="{{ $vet->id }}" {{ old('veterinario_id', $internacion->veterinario_id) == $vet->id ? 'selected' : '' }}>
                                {{ $vet->personal->nombre }} {{ $vet->personal->apellido }}
                            </option>
                        @endforeach
                    </select>
                    @error('veterinario_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Actualizar Internación</button>
                </div>
            </form>
        </div>
    </div>
@endsection
