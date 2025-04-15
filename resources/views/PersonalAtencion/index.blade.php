@extends('adminlte::page')

@section('title', 'Listado de Personal de Atencion')

@section('content_header')
    <h1>Listado de Personal de Atencion </h1>
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <a href="{{ route('atencion.create') }}" class="btn btn-primary">Nuevo Personal Atencion</a>
        </div>

        <div class="card-body">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Cargo</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($atencion as $p)
                        <tr>
                            <td>{{ $p->personal->nombre }}</td>
                            <td>{{ $p->personal->apellido }}</td>
                            <td>{{ $p->cargo }}</td>
                            <td>{{ $p->email }}</td>
                            <td>
                                <a href="{{ route('atencion.edit', $p->id) }}" class="btn btn-sm btn-warning">Editar</a>

                                <form action="{{ route('atencion.destroy', $p->id) }}" method="POST"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('¿Estás seguro de eliminar este registro?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
<div class="d-flex justify-content-center">
    {{ $atencion->links() }}
</div>
