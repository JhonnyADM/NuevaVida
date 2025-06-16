@extends('adminlte::page')

@section('title', 'Lista de Roles')

@section('content_header')
    <h1>Roles</h1>
@stop

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($roles as $role)
                <tr>
                    <td>{{ $role->id }}</td>
                    <td>{{ ucfirst($role->name) }}</td>
                    <td>
                        <a href="{{ route('roles.permissions.edit', $role) }}" class="btn btn-sm btn-primary">
                            Editar Permisos
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop
