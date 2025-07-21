@extends('adminlte::page')

@section('title', 'Editar Area')

@section('content_header')
    <h1>Editar Area</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('area.update', $area->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label for="nombre">nombre</label>
                    <textarea name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror" rows="4">{{ old('nombre', $area->nombre) }}</textarea>
                    @error('nombre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="descripcion">Descripcion</label>
                    <textarea name="descripcion" id="descripcion" class="form-control @error('descripcion') is-invalid @enderror" rows="4">{{ old('descripcion', $area->descripcion) }}</textarea>
                    @error('descripcion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Actualizar area</button>
                </div>
            </form>
        </div>
    </div>
@endsection
