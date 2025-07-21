@extends('adminlte::page')

@section('title', 'Atenciones Registradas')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="mb-0">Listado de Turnos de Trabajo</h1>
        <a href="{{ route('turno.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Nueva Turno
        </a>
    </div>
@endsection
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Hora Inicio</th>
                        <th>Hora Fin</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($turnos as $turno)
                        <tr>
                            <td>{{ $turno->id }}</td>
                            <td>{{ $turno->nombre ?? 'Sin Nombre' }}</td>
                            <td>{{ $turno->hora_inicio->format('H:i') ?? 'No registrado' }}</td>
                            <td>{{ $turno->hora_fin->format('H:i') ?? 'No registrado' }}</td>
                            <td>
                                <a href="{{ route('turno.edit', $turno->id) }}"
                                    class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> Editar
                                </a>

                                <form action="{{ route('turno.destroy', $turno->id) }}" method="POST"
                                    style="display:inline-block;"
                                    onsubmit="return confirm('¿Está seguro de eliminar Turno?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i> Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No hay Turnos registrados aún.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            {{ $turnos->links() }}
        </div>
    </div>
@stop
