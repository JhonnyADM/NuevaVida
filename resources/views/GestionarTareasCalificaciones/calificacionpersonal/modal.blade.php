<!-- Modal de calificación para {{ $personal->nombre }} -->
<div class="modal fade" id="modalCalificar{{ $personal->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form action="{{ route('calificaciones.store') }}" method="POST">
            @csrf
            @if (Auth::user()->personal->cliente)
                <input type="hidden" name="cliente_id" value="{{ Auth::user()->personal->cliente->id }}">
            @else
                <div class="alert alert-danger">
                    No se encontró información de cliente asociada a este usuario.
                </div>
            @endif

            <input type="hidden" name="personal_id" value="{{ $personal->id }}">

            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Califica a {{ $personal->nombre }}</h5>
                    <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label>Personal</label>
                        <input type="text" class="form-control" value="{{ $personal->nombre }}" disabled>
                    </div>

                    <div class="form-group">
                        <label>Calificación</label>
                        <div id="starRating{{ $personal->id }}">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star star" data-value="{{ $i }}"></i>
                            @endfor
                        </div>
                        <input type="hidden" name="valor" id="valor{{ $personal->id }}" required>
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
