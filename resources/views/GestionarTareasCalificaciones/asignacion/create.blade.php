@extends('adminlte::page')

@section('title', 'Asignar Tareas')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <h3>Asignar Pasantes y Voluntarios a una Tarea</h3>
        </div>
        <form method="POST" action="{{ route('asignaciones.store') }}">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="tarea_id">Tarea</label>
                    <select name="tarea_id" class="form-control" required>
                        @foreach ($tareas as $tarea)
                            <option value="{{ $tarea->id }}">{{ $tarea->descripcion }} ({{ $tarea->fecha }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Pasantes</label>
                    @foreach ($pasantes as $pasante)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="pasantes[]" value="{{ $pasante->id }}">
                            <label class="form-check-label">{{ $pasante->personal->nombre }}</label>
                        </div>
                    @endforeach
                </div>

                <div class="form-group">
                    <label>Voluntarios</label>
                    @foreach ($voluntarios as $voluntario)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="voluntarios[]"
                                value="{{ $voluntario->id }}">
                            <label class="form-check-label">{{ $voluntario->personal->nombre }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary" type="submit">Guardar Asignación</button>
            </div>
        </form>
    </div>
@endsection
