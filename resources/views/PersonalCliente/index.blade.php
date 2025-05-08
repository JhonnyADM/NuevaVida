@extends('adminlte::page')

@section('title', 'Listado de Clientes')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="mb-0">Listado de Clientes</h1>
    </div>
@endsection

@section('content')
    {{-- Mensajes de éxito y error --}}
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

    <div class="card mt-3">
        <div class="card-header bg-primary text-white">
            <strong>Clientes registrados</strong>
        </div>
        <div class="card-body p-0">
            <table class="table table-bordered table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th class="text-center" style="width: 35%">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($cliente as $p)
                        <tr>
                            <td>{{ $p->personal->nombre }}</td>
                            <td>{{ $p->personal->apellido }}</td>
                            <td class="text-center">
                                <a href="{{ route('cliente.edit', $p->id) }}" class="btn btn-sm btn-warning me-1">
                                    <i class="fas fa-edit"></i> Editar
                                </a>

                                <form action="{{ route('cliente.destroy', $p->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar este cliente?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger me-1">
                                        <i class="fas fa-trash-alt"></i> Eliminar
                                    </button>
                                </form>

                                <a href="{{ route('cliente.mascota.create', $p->id) }}" class="btn btn-sm btn-success me-1">
                                    <i class="fas fa-plus"></i> Mascota
                                </a>

                                <a href="{{ route('cliente.mascota.index', $p->id) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-list"></i> Ver Mascotas
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted">No hay clientes registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($cliente->hasPages())
            <div class="card-footer d-flex justify-content-center">
                {{ $cliente->links() }}
            </div>
        @endif
    </div>
@endsection
