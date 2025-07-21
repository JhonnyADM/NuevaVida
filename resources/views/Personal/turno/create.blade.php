@extends('adminlte::page')

@section('title', 'Nuevo Turno')

@section('content_header')
    <h1>Registro de Turnos</h1>
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
            <form action="{{ route('turno.store') }}" method="POST">
                @csrf

                 <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <textarea name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror" rows="3">{{ old('nombre') }}</textarea>
                    @error('nombre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="hora_inicio">Hora Inicio</label>
                    <input type="time" name="hora_inicio" id="hora_inicio" class="form-control @error('hora_inicio') is-invalid @enderror" value="{{ old('hora_inicio') }}">
                    @error('hora_inicio')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group
                    <label for="hora_fin">Hora Fin</label>
                    <input type="time" name="hora_fin" id="hora_fin" class="form-control @error('hora_fin') is-invalid @enderror" value="{{ old('hora_fin') }}">
                    @error('hora_fin')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Guardar Area
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
