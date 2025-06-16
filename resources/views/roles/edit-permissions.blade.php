@extends('adminlte::page')

@section('title', 'Editar Permisos del Rol')

@section('content_header')
    <h1 class="mb-3">Editar permisos del rol: <strong>{{ ucfirst($role->name) }}</strong></h1>
@stop

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li><i class="fas fa-exclamation-circle"></i> {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('roles.permissions.update', $role) }}" method="POST">
        @csrf

        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <strong>Lista de Permisos</strong>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach($permissions->sortBy('name') as $permiso)
                        <div class="col-md-4 mb-2">
                            <div class="form-check">
                                <input
                                    type="checkbox"
                                    name="permissions[]"
                                    value="{{ $permiso->id }}"
                                    id="perm_{{ $permiso->id }}"
                                    class="form-check-input"
                                    {{ in_array($permiso->id, $rolePermissions) ? 'checked' : '' }}
                                >
                                <label class="form-check-label" for="perm_{{ $permiso->id }}">
                                    {{ $permiso->name }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="mt-4 d-flex justify-content-between">
            <a href="{{ route('roles.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
            <button type="submit" class="btn btn-success">
                <i class="fas fa-save"></i> Guardar Cambios
            </button>
        </div>
    </form>
@stop
