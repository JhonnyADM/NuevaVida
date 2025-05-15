@extends('adminlte::page')

@section('title', 'Editar Estado')

@section('content_header')
    <h1>Editar Estado</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('estado.update', $estados->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <input type="text" name="descripcion" class="form-control" id="descripcion"
                        value="{{ old('descripcion', $estados->descripcion) }}" required>
                    @error('descripcion')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Actualizar
                    </button>
                    <a href="{{ route('estado.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
