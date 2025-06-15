@extends('adminlte::page')

@section('title', 'Atenciones Registradas')

@section('content_header')
    <h1 class="mb-4">Atenciones de Mascotas</h1>
@stop

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
                        <th>Personal Encargado</th>
                        <th>Cliente</th>
                        <th>Mascota</th>
                        <th>Servicios</th>
                        <th>Fecha Recibo</th>
                        <th>Total (Bs)</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recibos as $recibo)
                        <tr>
                            <td>{{ $recibo->id }}</td>
                            <td>{{ $recibo->atencion->personal->nombre ?? 'Sin Nombre' }}</td>
                            <td>{{ $recibo->cliente->personal->nombre ?? 'Sin Nombre' }}</td>
                            <td>{{ $recibo->mascota->nombre ?? 'Sin datos' }}</td>
                            <td>
                                {{ $recibo->servicios->pluck('nombre')->implode(', ') ?: 'Varios' }}
                            </td>
                            <td>{{ optional($recibo->fecha)->format('d/m/Y') ?? 'No registrado' }}</td>
                            <td>{{ number_format($recibo->total ?? 0, 2) }}</td>
                            <td>
                                <a href="{{ route('solicitar-servicio.show', $recibo->id) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i> Ver
                                </a>
                                <a href="{{ route('solicitar-servicio.edit', $recibo->id) }}"
                                    class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> Editar
                                </a>

                                <form action="{{ route('solicitar-servicio.destroy', $recibo->id) }}" method="POST"
                                    style="display:inline-block;"
                                    onsubmit="return confirm('¿Está seguro de eliminar este recibo?')">
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
                            <td colspan="7" class="text-center">No hay atenciones registradas aún.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            {{ $recibos->links() }}
        </div>
    </div>
@stop
