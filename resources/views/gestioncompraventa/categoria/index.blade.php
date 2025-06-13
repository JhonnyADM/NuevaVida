@extends('adminlte::page')

@section('title', 'Listado de Catagorias')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="mb-0">Listado de Categorias</h1>
        <a href="{{ route('categoria.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Nueva Categoria
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
                        <th>Descripción</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categorias as $categoria)
                        <tr>
                            <td>{{ $categoria->descripcion }}</td>
                            <td class="text-center">
                                <a href="{{ route('categoria.edit', $categoria->id) }}" class="btn btn-sm btn-warning me-1">
                                    <i class="fas fa-edit"></i> Editar
                                </a>

                                <form action="{{ route('categoria.destroy', $categoria->id) }}" method="POST"
                                    style="display:inline-block;" onsubmit="return confirm('¿Estás seguro de eliminar esta Categoria?')">
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
                            <td colspan="4" class="text-center text-muted">No hay Provedores registradas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Paginación --}}
            <div class="d-flex justify-content-center mt-3">
                {{ $categorias->links() }}
            </div>
        </div>
    </div>
@endsection
