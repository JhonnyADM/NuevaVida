@extends('adminlte::page')

@section('title', 'Listado de area de Trabajo')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="mb-0">Listado de Areas de trabajo</h1>
        <a href="{{ route('area.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Nueva Area
        </a>
    </div>
@endsection

@section('content')
    {{-- Mensajes de éxito o error --}}
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

    {{-- Tabla de tareas --}}
    <div class="card mt-3">
        <div class="card-body">
            <table class="table table-hover table-bordered table-striped">
                <thead class="table-dark text-center">
                    <tr>
                        <th>Nombre</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($areas as $area)
                        <tr>
                            <td>{{ $area->nombre }}</td>
                            <td class="text-center">
                                <a href="{{ route('area.edit', $area->id) }}" class="btn btn-sm btn-warning me-1">
                                    <i class="fas fa-edit"></i> Editar
                                </a>

                                <form action="{{ route('area.destroy', $area->id) }}" method="POST"
                                    style="display:inline-block;" onsubmit="return confirm('¿Estás seguro de eliminar esta Area?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash-alt"></i> Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">No hay Areas registradas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Paginación --}}
            <div class="d-flex justify-content-center mt-3">
                {{ $areas->links() }}
            </div>
        </div>
    </div>
@endsection
