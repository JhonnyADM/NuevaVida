@extends('adminlte::page')

@section('title', 'Crear Nuevo Estado')

@section('content_header')
    <h1>Crear Nuevo Estado</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('estado.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <input type="text" name="descripcion" class="form-control" id="descripcion"
                        placeholder="Ingrese descripción de la raza" required>
                    @error('descripcion')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Guardar
                    </button>
                    <a href="{{ route('estado.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
