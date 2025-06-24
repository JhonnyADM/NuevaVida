@extends('adminlte::page')

@section('title', 'Tareas por Pasante')

@section('content_header')
    <h1>Tareas asignadas a Pasantes</h1>
@stop

@section('content')
<div class="mb-3">
    <button onclick="imprimirTodo()" class="btn btn-success">🖨 Imprimir todas las asignaciones</button>
</div>

<div id="contenido-imprimible">
    @foreach($pasantes as $pasante)
        <div class="card my-3">
            <div class="card-header">
                <strong>{{ $pasante->personal->nombre ?? 'Sin nombre' }}</strong>
            </div>
            <div class="card-body">
                @forelse($pasante->tareas as $tarea)
                    <div class="mb-2 border-bottom pb-2">
                        <strong>Tarea:</strong> {{ $tarea->descripcion }} <br>
                        <strong>Fecha:</strong> {{ $tarea->fecha }} <br>
                        <strong>Asignado el:</strong> {{ $tarea->pivot->asignado_en }}
                    </div>
                @empty
                    <p class="text-muted">No tiene tareas asignadas.</p>
                @endforelse
            </div>
        </div>
    @endforeach
</div>
@endsection

@section('js')
<script>
    function imprimirTodo() {
        const original = document.body.innerHTML;
        const content = document.getElementById('contenido-imprimible').innerHTML;
        document.body.innerHTML = content;
        window.print();
        document.body.innerHTML = original;
        location.reload();
    }
</script>
@endsection
