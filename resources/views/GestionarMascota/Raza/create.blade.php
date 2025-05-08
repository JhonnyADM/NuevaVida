@extends('adminlte::page')

@section('title', 'Crear Nueva Raza')

@section('content_header')
    <h1>Crear Nueva Raza</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('raza.store') }}" method="POST">
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
                    <a href="{{ route('raza.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
