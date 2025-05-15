@extends('adminlte::page')
@section('title', 'Lista de Estados')

@section('content_header')
    <h1>Lista de Estados</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">Estados de Mascotas</h3>
            <a href="{{ route('estado.create') }}" class="btn btn-primary">Agregar Estado</a>
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
                    @foreach ($estados as $estado)
                        <tr>
                            <td>{{ $estado->descripcion }}</td>
                            <td>
                                <a href="{{ route('estado.edit', $estado->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                <form action="{{ route('estado.destroy', $estado->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Desea eliminar este estado?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="card-footer d-flex justify-content-between align-items-center">
            <p class="mb-0">Mostrando {{ $estados->firstItem() }} a {{ $estados->lastItem() }} de {{ $estados->total() }} estados</p>
            {{ $estados->links() }}
        </div>
    </div>
@endsection
