@extends('adminlte::page')

@section('title', 'Calificar Servicio')

@section('content')
<!-- Botón para abrir el modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#crearCalificacionModal">
  Calificar Servicio
</button>

<!-- Modal -->
<div class="modal fade" id="crearCalificacionModal" tabindex="-1" role="dialog" aria-labelledby="crearCalificacionModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="{{ route('calificacion.store') }}" method="POST">
      @csrf
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h5 class="modal-title text-white" id="crearCalificacionModalLabel">Califica este Servicio</h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Cerrar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">

          {{-- Campo oculto: Cliente --}}
          <input type="hidden" name="cliente_id" value="{{ Auth::id() }}">

          {{-- Campo oculto: Servicio --}}
          <input type="hidden" name="servicio_id" value="{{ $servicio->id }}">

          {{-- Mostrar nombre del servicio --}}
          <div class="form-group">
            <label>Servicio</label>
            <input type="text" class="form-control" value="{{ $servicio->nombre }}" disabled>
          </div>

          {{-- Selector de estrellas --}}
          <div class="form-group">
            <label for="valor">Calificación</label>
            <div id="starRating" class="mb-2">
              @for ($i = 1; $i <= 5; $i++)
                <i class="fas fa-star star" data-value="{{ $i }}"></i>
              @endfor
            </div>
            <input type="hidden" name="valor" id="valor" required>
          </div>

          {{-- Comentario opcional --}}
          <div class="form-group">
            <label for="comentario">Comentario (opcional)</label>
            <textarea name="comentario" id="comentario" class="form-control" rows="3" placeholder="¿Algo que quieras destacar?"></textarea>
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
    const stars = document.querySelectorAll('#starRating .star');
    const valorInput = document.getElementById('valor');

    stars.forEach(star => {
      star.addEventListener('click', function () {
        const rating = this.getAttribute('data-value');
        valorInput.value = rating;

        // Limpiar selección
        stars.forEach(s => {
          s.classList.remove('selected');
        });

        // Seleccionar las estrellas hasta la elegida
        stars.forEach(s => {
          if (s.getAttribute('data-value') <= rating) {
            s.classList.add('selected');
          }
        });
      });
    });
  });
</script>
@endsection
