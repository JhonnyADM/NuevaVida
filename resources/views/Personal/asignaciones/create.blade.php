@extends('adminlte::page')

@section('title', 'Nueva Asignación')

@section('content_header')
    <h1>Crear Nueva Asignación</h1>
@endsection

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Datos de la Asignación</h3>
        </div>
        <form method="POST" action="{{ route('asignacionesturnos.store') }}">
            @csrf
            <div class="card-body">
                <x-adminlte-select name="personal_id" label="Personal" required>
                    @foreach ($personales as $p)
                        @php
                            $roles = [];
                            if ($p->veterinario) {
                                $roles[] = 'Veterinario';
                            }
                            if ($p->atencion) {
                                $roles[] = 'Atención';
                            }
                            $etiqueta = $roles ? ' (' . implode(', ', $roles) . ')' : '';
                        @endphp
                        <option value="{{ $p->id }}">{{ $p->nombre . $etiqueta }}</option>
                    @endforeach
                </x-adminlte-select>


                <x-adminlte-select name="area_id" label="Área" required>
                    @foreach ($areas as $a)
                        <option value="{{ $a->id }}">{{ $a->nombre }}</option>
                    @endforeach
                </x-adminlte-select>

                <x-adminlte-select name="turno_id" label="Turno" required>
                    @foreach ($turnos as $t)
                        <option value="{{ $t->id }}">
                            {{ $t->nombre }} ({{ $t->hora_inicio->format('H:i') }} - {{ $t->hora_fin->format('H:i') }})
                        </option>
                    @endforeach
                </x-adminlte-select>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success">Guardar</button>
                <a href="{{ route('asignacionesturnos.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
@endsection
