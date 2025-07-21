@extends('adminlte::page')

@section('title', 'Editar Turno')

@section('content_header')
    <h1>Editar Turno</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('turno.update', $turno->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label for="nombre">nombre</label>
                    <textarea name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror" rows="4">{{ old('nombre', $turno->nombre) }}</textarea>
                    @error('nombre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="hora_inicio">Hora Inicio</label>
                    <input type="time" name="hora_inicio" id="hora_inicio" class="form-control @error('hora_inicio') is-invalid @enderror" value="{{ old('hora_inicio', $turno->hora_inicio->format('H:i')) }}">
                    @error('hora_inicio')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="hora_fin">Hora Fin</label>
                    <input type="time" name="hora_fin" id="hora_fin" class="form-control @error('hora_fin') is-invalid @enderror" value="{{ old('hora_fin', $turno->hora_fin->format('H:i')) }}">
                    @error('hora_fin')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Actualizar Turno</button>
                </div>
            </form>
        </div>
    </div>
@endsection
