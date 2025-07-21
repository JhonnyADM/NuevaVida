@extends('adminlte::page')

@section('title', 'Vida Nueva - Panel Principal')

@section('content_header')
    <h1 class="text-primary">
        <i class="fas fa-clinic-medical"></i> Clínica Veterinaria Vida Nueva
    </h1>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow border-0">
            <div class="card-body text-center">
                <h3 class="text-success mb-4">
                    <i class="fas fa-paw"></i> Bienvenido al Panel de Gestión
                </h3>
                <p class="lead mb-4">
                    Desde aquí podrás acceder a las opciones correspondientes según tu rol asignado.
                </p>
                <hr>

                {{-- CLIENTE --}}
                @if (Auth::user()->hasRole('cliente'))
                    <h4 class="text-info mb-4">Servicios disponibles para ti</h4>
                    <div class="row justify-content-center">
                        @forelse($servicios as $servicio)
                            <div class="col-md-4 mb-4">
                                <div class="card h-100 border-primary shadow-sm">
                                    <div class="card-body text-center">
                                        <h5 class="card-title text-primary">
                                            <i class="fas fa-stethoscope"></i> {{ $servicio->nombre }}
                                        </h5>
                                        <p class="text-muted">Disponible</p>
                                        <button class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#modalCalificacionServicio{{ $servicio->id }}">
                                            Calificar Servicio
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal de calificación -->
                            <div class="modal fade" id="modalCalificacionServicio{{ $servicio->id }}" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <form action="{{ route('calificacion.store') }}" method="POST">
                                        @csrf
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary text-white">
                                                <h5 class="modal-title">Califica el Servicio</h5>
                                                <button type="button" class="close text-white" data-dismiss="modal">
                                                    <span>&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" name="cliente_id" value="{{ Auth::id() }}">
                                                <input type="hidden" name="servicio_id" value="{{ $servicio->id }}">

                                                <div class="form-group">
                                                    <label>Servicio</label>
                                                    <input type="text" class="form-control" value="{{ $servicio->nombre }}" disabled>
                                                </div>

                                                <div class="form-group">
                                                    <label>Calificación</label>
                                                    <div id="starRating{{ $servicio->id }}">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            <i class="fas fa-star star" data-value="{{ $i }}"></i>
                                                        @endfor
                                                    </div>
                                                    <input type="hidden" name="valor" id="valor{{ $servicio->id }}" required>
                                                </div>

                                                <div class="form-group">
                                                    <label>Comentario (opcional)</label>
                                                    <textarea name="comentario" class="form-control" rows="3" placeholder="¿Algo que quieras destacar?"></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-success">Guardar Calificación</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <p class="text-muted">No hay servicios disponibles por el momento.</p>
                        @endforelse
                    </div>

                {{-- ADMINISTRATIVO --}}
                @else
                    <div class="row mt-4">
                        <div class="col-md-4 mb-4">
                            <div class="info-box bg-info">
                                <span class="info-box-icon"><i class="fas fa-users"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Clientes</span>
                                    <a href="{{ route('personal.index') }}" class="text-white">
                                        <span class="info-box-number">Registro de Personal</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-4">
                            <div class="info-box bg-success">
                                <span class="info-box-icon"><i class="fas fa-dog"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Adopciones</span>
                                    <a href="{{ route('adopciones.index') }}" class="text-white">
                                        <span class="info-box-number">Mascotas en Adopción</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-4">
                            <div class="info-box bg-warning">
                                <span class="info-box-icon"><i class="fas fa-notes-medical"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Historial Clínico</span>
                                    <a href="{{ route('reporte.historial.seleccionar-cliente') }}" class="text-white">
                                        <span class="info-box-number">Reporte General</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <a href="{{ url('solicitar-servicio/seleccionar-cliente') }}" class="btn btn-success btn-lg">
                            <i class="fas fa-plus-circle"></i> Registar Recibo
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
    <style>
        .star {
            font-size: 1.8rem;
            color: #ddd;
            cursor: pointer;
            transition: color 0.2s;
        }

        .star.selected {
            color: #ffc107;
        }
    </style>
@endsection

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @foreach ($servicios as $servicio)
                const stars{{ $servicio->id }} = document.querySelectorAll('#starRating{{ $servicio->id }} .star');
                const valorInput{{ $servicio->id }} = document.getElementById('valor{{ $servicio->id }}');

                stars{{ $servicio->id }}.forEach(star => {
                    star.addEventListener('click', function() {
                        const rating = this.getAttribute('data-value');
                        valorInput{{ $servicio->id }}.value = rating;

                        stars{{ $servicio->id }}.forEach(s => {
                            s.classList.remove('selected');
                            if (s.getAttribute('data-value') <= rating) {
                                s.classList.add('selected');
                            }
                        });
                    });
                });
            @endforeach
        });
    </script>
@endsection
