@extends('adminlte::page')

@section('title', 'Crear Nueva Tarea')

@section('content_header')
    <h1>Crear Nueva Tarea</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('tarea.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <input type="text" name="descripcion" class="form-control" id="descripcion"
                        placeholder="Ingrese descripción de la tarea" value="{{ old('descripcion') }}" required>
                    @error('descripcion')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group mt-3">
                    <label for="fecha">Fecha</label>
                    <input type="date" name="fecha" class="form-control" id="fecha" value="{{ old('fecha') }}">
                    @error('fecha')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group mt-3">
                    <label for="estado_id">Estado</label>
                    <select name="estado_id" class="form-control" id="estado_id" required>
                        <option value="">Seleccione un estado</option>
                        @foreach ($estado as $es)
                            <option value="{{ $es->id }}"
                                {{ old('estado_id') == $es->id ? 'selected' : '' }}>
                                {{ $es->descripcion }}
                            </option>
                        @endforeach
                    </select>
                    @error('estado_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Guardar
                    </button>
                    <a href="{{ route('tarea.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
