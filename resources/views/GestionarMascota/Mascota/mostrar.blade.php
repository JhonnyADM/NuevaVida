@extends('adminlte::page')

@section('title', 'Mascotas en Adopción')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="text-primary">Mascotas en Adopción</h1>
        <a href="{{ route('mascota.crear') }}" class="btn btn-success">
            <i class="fas fa-plus-circle"></i> Registrar Nueva Mascota
        </a>
    </div>
    <p class="text-muted">Lista de mascotas registradas y disponibles para ser adoptadas.</p>
@stop

@section('content')
    @if (session('success'))
        <x-adminlte-alert theme="success" title="Éxito" dismissable>
            {{ session('success') }}
        </x-adminlte-alert>
    @endif

    <div class="card shadow">
        <div class="card-header bg-info text-white">
            <strong><i class="fas fa-paw"></i> Listado de Mascotas</strong>
        </div>

        <div class="card-body table-responsive p-0">
            <table class="table table-hover table-striped table-bordered mb-0">
                <thead class="table-dark">
                    <tr class="text-center">
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
                        <tr class="text-center align-middle">
                            <td>{{ $m->nombre }}</td>
                            <td>{{ $m->color }}</td>
                            <td>{{ $m->edad }} años</td>
                            <td>{{ $m->peso }} kg</td>
                            <td>{{ $m->raza->descripcion }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-2 flex-wrap">
                                    <a href="{{ route('mascota.editar', $m->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>

                                    <form action="{{ route('mascota.eliminar', $m->id) }}" method="POST" onsubmit="return confirm('¿Deseas eliminar esta mascota?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash-alt"></i> Eliminar
                                        </button>
                                    </form>
                                </div>
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
@stop
