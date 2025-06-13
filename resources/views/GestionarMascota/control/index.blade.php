@extends('adminlte::page')

@section('title', 'Control de tratamiento' )

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>controles de Tratamientos de {{ $mascota->nombre }} </h1>
        <a href="{{ route('cliente.mascota.tratamiento.control.create', [$cliente->id, $mascota->id, $tratamiento->id]) }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Nuevo Control de Tratamiento
        </a>
    </div>
@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Observacion</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($controles as $control)
                <tr>
                    <td>{{ $control->Observacion }}</td>
                   <td>{{ \Carbon\Carbon::parse($control->fecha)->format('d/m/Y') }}</td>
                    <td>
                        <a href="{{ route('cliente.mascota.tratamiento.control.edit', [$cliente->id, $mascota->id, $tratamiento->id, $control->id]) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <form action="{{ route('cliente.mascota.tratamiento.control.destroy', [$cliente->id, $mascota->id, $tratamiento->id, $control->id]) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('¿Eliminar este Control de Tratamiento?')" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash-alt"></i> Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center">No hay controles de tratamientos registrados.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $controles->links() }}
@endsection
