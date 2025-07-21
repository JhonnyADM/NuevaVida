@extends('adminlte::page')

@section('title', 'Calificaciones al Personal')

@section('content_header')
    <h1>Calificaciones de Clientes al Personal</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Personal</th>
                        <th>Tipo</th>
                        <th>Estrellas</th>
                        <th>Comentario</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($calificaciones as $c)
                        <tr>
                            <td>{{ $c->cliente->personal->nombre }}</td>
                            <td>{{ $c->personal->nombre }}</td>
                            <td>
                                @if ($c->personal->veterinario)
                                    <span class="badge bg-success">Veterinario</span>
                                @endif
                                @if ($c->personal->atencion)
                                    <span class="badge bg-info">Atención</span>
                                @endif
                            </td>
                            <td>
                                @for ($i = 0; $i < $c->valor; $i++)
                                    <i class="fas fa-star text-warning"></i>
                                @endfor
                            </td>
                            <td>{{ $c->comentario }}</td>
                            <td>
                                <form action="{{ route('calificaciones.destroy', $c) }}" method="POST" class="d-inline-block">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar calificación?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
