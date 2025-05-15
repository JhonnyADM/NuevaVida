@extends('adminlte::page')

@section('title', 'Credenciales de Usuario')

@section('content_header')
    <h1 class="text-center text-primary">🎉 Usuario creado exitosamente</h1>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-primary">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-user-check"></i> Credenciales de acceso</h4>
                </div>

                <div class="card-body text-center">
                    <p class="mb-4">Guarda esta información para que el usuario pueda ingresar al sistema:</p>

                    <div class="alert alert-info">
                        <h5><i class="fas fa-id-badge"></i> Código de acceso:</h5>
                        <h3 class="fw-bold">{{ $codigo }}</h3>
                    </div>

                    <div class="alert alert-warning">
                        <h5><i class="fas fa-lock"></i> Contraseña temporal:</h5>
                        <h3 class="fw-bold">{{ $password }}</h3>
                        <small class="text-muted">Se recomienda cambiarla al primer ingreso.</small>
                    </div>

                    <a href="{{ route('personal.index') }}" class="btn btn-success mt-3">
                        <i class="fas fa-arrow-left"></i> Volver al listado de personal
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
