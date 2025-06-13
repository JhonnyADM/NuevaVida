@extends('adminlte::page')

@section('title', 'Editar Tarea')

@section('content_header')
    <h1>Editar Tarea</h1>
@endsection

@section('content')
    <div class="card mt-3">
        <div class="card-body">
            <form action="{{ route('tarea.update', $tarea->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Descripción --}}
                <div class="form-group mb-3">
                    <label for="descripcion">Descripción</label>
                    <input type="text" name="descripcion" class="form-control" id="descripcion"
                        value="{{ old('descripcion', $tarea->descripcion) }}" required>
                    @error('descripcion')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Fecha --}}
                <div class="form-group mb-3">
                    <label for="fecha">Fecha</label>
                    <input type="date" name="fecha" class="form-control" id="fecha"
                        value="{{ old('fecha', $tarea->fecha) }}" required>
                    @error('fecha')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Estado --}}
                <div class="form-group mb-3">
                    <label for="estado_id">Estado</label>
                    <select name="estado_id" class="form-control" required>
                        <option value="">Seleccione un Estado</option>
                        @foreach ($estados as $estado)
                            <option value="{{ $estado->id }}"
                                {{ old('estado_id', $tarea->estado_id) == $estado->id ? 'selected' : '' }}>
                                {{ $estado->descripcion }}
                            </option>
                        @endforeach
                    </select>
                    @error('estado_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Botones --}}
                <div class="mt-4">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Actualizar
                    </button>
                    <a href="{{ route('tarea.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
