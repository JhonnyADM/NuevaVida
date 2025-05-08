@extends('adminlte::page')

@section('title', 'Listado de Mascotas')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="mb-0">
            Mascotas de {{ $cliente->personal->nombre ?? 'Cliente' }} {{ $cliente->personal->apellido ?? '' }}
        </h1>
        <a href="{{ route('cliente.mascota.create', $cliente->id) }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Nueva Mascota
        </a>
    </div>
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    @endif

    <div class="card mt-3">
        <div class="card-header bg-primary text-white">
            <strong>Listado de Mascotas Registradas</strong>
        </div>
        <div class="card-body p-0">
            <table class="table table-bordered table-striped mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Color</th>
                        <th>Edad</th>
                        <th>Peso</th>
                        <th>Raza</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($mascotas as $m)
                        <tr>
                            <td>{{ $m->nombre }}</td>
                            <td>{{ $m->color }}</td>
                            <td>{{ $m->edad }}</td>
                            <td>{{ $m->peso }} kg</td>
                            <td>{{ $m->raza->descripcion }}</td>
                            <td>
                                <a href="{{ route('cliente.mascota.edit', [$cliente->id, $m->id]) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Editar
                                </a>
                                <form action="{{ route('cliente.mascota.destroy', [$cliente->id, $m->id]) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar esta mascota?')">
                                        <i class="fas fa-trash-alt"></i> Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">No hay mascotas registradas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($mascotas->hasPages())
            <div class="card-footer d-flex justify-content-center">
                {{ $mascotas->links() }}
            </div>
        @endif
    </div>
@endsection
