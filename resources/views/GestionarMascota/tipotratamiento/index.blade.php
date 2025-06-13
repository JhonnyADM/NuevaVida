@extends('adminlte::page')
@section('title', 'Lista de Tipos de Tratamiento')

@section('content_header')
    <h1>Lista de TTipos de Tratamiento</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">Tipos de Tratamiento</h3>
            <a href="{{ route('tipotratamiento.create') }}" class="btn btn-primary">Agregar tipo de tratamiento</a>
        </div>

        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tipo as $estado)
                        <tr>
                            <td>{{ $estado->descripcion }}</td>
                            <td>
                                <a href="{{ route('tipotratamiento.edit', $estado->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                <form action="{{ route('tipotratamiento.destroy', $estado->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Desea eliminar este Tipo de Tratamiento?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="card-footer d-flex justify-content-between align-items-center">
            <p class="mb-0">Mostrando {{ $tipo->firstItem() }} a {{ $tipo->lastItem() }} de {{ $tipo->total() }} estados</p>
            {{ $tipo->links() }}
        </div>
    </div>
@endsection
