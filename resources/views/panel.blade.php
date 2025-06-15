@extends('adminlte::page')

@section('title', 'Vida Nueva - Panel Principal')

@section('content_header')
    <h1 class="text-teal-700">
        <i class="fas fa-clinic-medical"></i> Clínica Veterinaria Vida Nueva
    </h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card bg-light shadow-lg">
                <div class="card-body text-center">
                    <h3 class="text-success mb-3">
                        <i class="fas fa-paw"></i> Bienvenido al Panel de Gestión
                    </h3>
                    <p class="lead">
                        Desde aquí podrás gestionar toda la información de nuestros pacientes peludos 🐶🐱 y servicios.
                    </p>
                    <hr>

                    <div class="row mt-4">
                        <div class="col-md-4">
                            <div class="info-box bg-info">
                                <span class="info-box-icon"><i class="fas fa-users"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Clientes</span>
                                    <span class="info-box-number">Gestión completa</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="info-box bg-success">
                                <span class="info-box-icon"><i class="fas fa-dog"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Mascotas</span>
                                    <span class="info-box-number">Registros actualizados</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="info-box bg-warning">
                                <span class="info-box-icon"><i class="fas fa-notes-medical"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Atenciones</span>
                                    <span class="info-box-number">Historial completo</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Botón para registrar nuevo servicio --}}
                    <a href="{{ url('solicitar-servicio/seleccionar-cliente') }}"
                       class="btn btn-success btn-lg mt-4">
                        <i class="fas fa-plus-circle"></i> Registrar Nuevo Servicio
                    </a>

                    {{-- Botón para empezar a gestionar --}}
                </div>
            </div>
        </div>
    </div>
@endsection
