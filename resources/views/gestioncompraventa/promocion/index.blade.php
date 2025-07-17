@extends('adminlte::page')

@section('title', 'Lista de Promociones')

@section('content_header')
    <h1 class="text-dark">Promociones</h1>
@stop

@section('content')
@if (session('success'))
    <x-adminlte-alert theme="success" title="Éxito" dismissable>
        {{ session('success') }}
    </x-adminlte-alert>
@endif

<div class="card shadow">
    <div class="card-header d-flex justify-content-between align-items-center">
        <strong>Promociones Actuales</strong>
        <a href="{{ route('promociones.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus-circle"></i> Nueva Promoción
        </a>
    </div>

    <div class="card-body p-0 table-responsive">
        <table class="table table-bordered table-hover mb-0">
            <thead class="thead-dark">
                <tr class="text-center">
                    <th>Nombre</th>
                    <th>Servicios</th>
                    <th>Descuento</th>
                    <th>Total (Bs)</th>
                    <th>Estado</th>
                    <th>Fechas</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($promociones as $promo)
                    <tr class="text-center align-middle">
                        <td>{{ $promo->nombre }}</td>
                        <td>
                            <ul class="list-unstyled text-left">
                                @foreach ($promo->servicios as $s)
                                    <li>- {{ $s->nombre }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>{{ $promo->descuento }}%</td>
                        <td>Bs {{ number_format($promo->total_a_pagar, 2) }}</td>
                        <td>
                            <span class="badge {{ $promo->estado === 'activo' ? 'bg-success' : 'bg-secondary' }}">
                                {{ ucfirst($promo->estado) }}
                            </span>
                        </td>
                        <td>
                            <small>{{ $promo->fecha_inicio }}<br>al<br>{{ $promo->fecha_fin }}</small>
                        </td>
                        <td>
                            <a href="{{ route('promociones.edit', $promo->id) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i>
                            </a>

                            <form action="{{ route('promociones.destroy', $promo->id) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('¿Eliminar esta promoción?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">No hay promociones registradas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@stop
