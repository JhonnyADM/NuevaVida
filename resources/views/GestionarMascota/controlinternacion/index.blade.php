@extends('adminlte::page')

@section('title', 'Controles de Internación')

@section('content_header')
    <h1>Controles de Internación - Mascota</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <a href="{{ route('mascota.internacion.control.create', compact( 'mascota', 'tratamiento')) }}"
               class="btn btn-primary mb-3">
                <i class="fas fa-plus"></i> Nuevo Control
            </a>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Detalle</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($controles as $control)
                        <tr>
                            <td>{{ $control->detalle }}</td>
                            <td>{{ \Carbon\Carbon::parse($control->fecha)->format('d/m/Y H:i') }}</td>
                            <td>{{ $control->estado->descripcion ?? 'N/A' }}</td>
                            <td>
                                <a href="{{ route('mascota.internacion.control.edit', ['mascota' => $mascota, 'tratamiento' => $tratamiento, 'control' => $control->id]) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"> </i> Editar
                                </a>

                                <form action="{{ route('mascota.internacion.control.destroy', ['mascota' => $mascota, 'tratamiento' => $tratamiento, 'control' => $control->id]) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('¿Deseas eliminar este control?')" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i> Eliminar

                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    @if($controles->isEmpty())
                        <tr><td colspan="4" class="text-center">No hay registros aún</td></tr>
                    @endif
                </tbody>
            </table>

        </div>
    </div>
@endsection
