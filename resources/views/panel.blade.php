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
                {{-- Bienvenida general --}}
                <h3 class="text-success mb-3">
                    <i class="fas fa-paw"></i> Bienvenido al Panel de Gestión
                </h3>
                <p class="lead">
                    Desde aquí podrás acceder a las opciones correspondientes según tu rol.
                </p>
                <hr>

                {{-- CLIENTE --}}
                @if (Auth::user()->hasRole('cliente'))
                    <h4 class="text-primary">Servicios disponibles para ti</h4>
                    <div class="row justify-content-center mt-4">
                        @forelse($servicios as $servicio)
                            <div class="col-md-4 mb-3">
                                <div class="card border-primary h-100 shadow-sm">
                                    <div class="card-body text-center">
                                        <h5 class="card-title text-primary">
                                            <i class="fas fa-stethoscope"></i> {{ $servicio->nombre }}
                                        </h5>
                                        <p class="card-text text-muted">Servicio disponible</p>

                                        <!-- Botón para abrir el modal -->
                                        <button type="button"
                                                class="btn btn-outline-primary btn-sm"
                                                data-toggle="modal"
                                                data-target="#modalCalificacionServicio{{ $servicio->id }}">
                                            Calificar
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal de calificación por servicio -->
                            <div class="modal fade" id="modalCalificacionServicio{{ $servicio->id }}" tabindex="-1"
                                 role="dialog" aria-labelledby="modalLabel{{ $servicio->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form action="{{ route('calificacion.store') }}" method="POST">
                                        @csrf
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary">
                                                <h5 class="modal-title text-white" id="modalLabel{{ $servicio->id }}">
                                                    Califica el Servicio
                                                </h5>
                                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Cerrar">
                                                    <span aria-hidden="true">&times;</span>
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
                                                    <label for="valor">Calificación</label>
                                                    <div id="starRating{{ $servicio->id }}" class="mb-2">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            <i class="fas fa-star star" data-value="{{ $i }}"></i>
                                                        @endfor
                                                    </div>
                                                    <input type="hidden" name="valor" id="valor{{ $servicio->id }}" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="comentario">Comentario (opcional)</label>
                                                    <textarea name="comentario" class="form-control" rows="3" placeholder="¿Algo que quieras destacar?"></textarea>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-success">Guardar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <p class="text-muted">No hay servicios disponibles por el momento.</p>
                        @endforelse
                    </div>

                {{-- PERSONAL ADMINISTRATIVO --}}
                @else
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

                    <a href="{{ url('solicitar-servicio/seleccionar-cliente') }}" class="btn btn-success btn-lg mt-4">
                        <i class="fas fa-plus-circle"></i> Registrar Nuevo Servicio
                    </a>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
<style>
    .star {
        font-size: 2rem;
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
    document.addEventListener('DOMContentLoaded', function () {
        @foreach($servicios as $servicio)
            const stars{{ $servicio->id }} = document.querySelectorAll('#starRating{{ $servicio->id }} .star');
            const valorInput{{ $servicio->id }} = document.getElementById('valor{{ $servicio->id }}');

            stars{{ $servicio->id }}.forEach(star => {
                star.addEventListener('click', function () {
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
