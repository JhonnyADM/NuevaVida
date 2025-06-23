@extends('adminlte::page')


@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="text-primary"><i class="fas fa-star-half-alt"></i> Historial Clinico</h1>
        <button class="btn btn-outline-dark" onclick="imprimirTodo()">
            <i class="fas fa-print"></i> Imprimir Reporte
        </button>
    </div>
@endsection
@section('content')
    <div class="container">
        <div class="form-group">
            <label for="mascota_id">Selecciona una Mascota:</label>
            <select id="mascota_id" class="form-control">
                <option value="">-- Elige una mascota --</option>
                @foreach ($mascotas as $mascota)
                    <option value="{{ $mascota->id }}">{{ $mascota->nombre }} ({{ $mascota->cliente->personal->nombre }})
                    </option>
                @endforeach
            </select>
        </div>

        <hr>

        <div id="historial-container">
            <p class="text-muted">Selecciona una mascota para ver su historial clínico.</p>
        </div>
    </div>
@endsection
@section('js')
<script>
    document.getElementById('mascota_id').addEventListener('change', function () {
        const mascotaId = this.value;

        if (mascotaId) {
            fetch(`/reporte/historial-clinico/ajax/${mascotaId}`)
                .then(response => response.text())
                .then(html => {
                    console.log('Respuesta AJAX:', html); // Verificar contenido
                    document.getElementById('historial-container').innerHTML = html;
                })
                .catch(error => console.error('Error al obtener historial:', error));
        } else {
            document.getElementById('historial-container').innerHTML =
                '<p class="text-muted">Selecciona una mascota para ver su historial clínico.</p>';
        }
    });
     function imprimirTodo() {
        window.print();
    }
</script>
@endsection


