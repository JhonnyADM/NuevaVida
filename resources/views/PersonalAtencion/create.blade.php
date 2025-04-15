@extends('adminlte::page')

@section('title', 'Registrar Atención')

@section('content_header')
    <h1>Registrar Atención</h1>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('atencion.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="personal_id">Seleccionar Personal</label>
                <select name="personal_id" class="form-control" required>
                    <option value="">-- Selecciona un personal --</option>
                    @foreach($personal as $p)
                        <option value="{{ $p->id }}">{{ $p->nombre }} {{ $p->apellido }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="cargo">Cargo</label>
                <textarea name="cargo" class="form-control" rows="3" placeholder=" Descripcion del Cargo" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Guardar Atención</button>
        </form>
    </div>
</div>
@endsection
