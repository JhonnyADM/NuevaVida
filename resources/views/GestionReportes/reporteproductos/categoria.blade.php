@extends('adminlte::page')

@section('title', 'Productos Vencidos por Categoría')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="text-danger"><i class="fas fa-boxes"></i> Productos Vencidos por Categoría</h1>
        <button class="btn btn-outline-dark" onclick="window.print()">
            <i class="fas fa-print"></i> Imprimir
        </button>
    </div>
@endsection

@section('content')
<div class="card">
    <div class="card-body printable-content">

        {{-- Filtro --}}
        <form method="GET" class="form-inline mb-4">
            <label for="filtro" class="mr-2">Filtrar por:</label>
            <select name="filtro" id="filtro" class="form-control mr-2" onchange="this.form.submit()">
                <option value="">-- Todos --</option>
                <option value="7" {{ request('filtro') == '7' ? 'selected' : '' }}>Últimos 7 días</option>
                <option value="30" {{ request('filtro') == '30' ? 'selected' : '' }}>Últimos 30 días</option>
            </select>
        </form>

        @php $hayProductos = false; @endphp

        @foreach($categorias as $categoria)
            @if($categoria->productos->count())
                @php $hayProductos = true; @endphp

                <h5 class="text-primary border-bottom pb-1 mb-3">
                    <i class="fas fa-tag"></i> {{ $categoria->descripcion }}
                </h5>

                <table class="table table-bordered table-sm mb-4">
                    <thead class="thead-light">
                        <tr>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Stock</th>
                            <th>Precio</th>
                            <th>Vencimiento</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categoria->productos as $producto)
                            <tr>
                                <td>{{ $producto->id }}</td>
                                <td>{{ $producto->nombre }}</td>
                                <td>{{ $producto->stock }}</td>
                                <td>S/. {{ number_format($producto->precio, 2) }}</td>
                                <td class="text-danger">{{ $producto->vencimiento->format('d/m/Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        @endforeach

        @unless($hayProductos)
            <p class="text-muted">No hay productos vencidos en este rango de tiempo.</p>
        @endunless

    </div>
</div>
@endsection

@section('css')
<style>
    @media print {
        body * { visibility: hidden; }
        .printable-content, .printable-content * {
            visibility: visible;
        }
        .printable-content {
            position: absolute;
            top: 0;
            left: 0;
            padding: 20px;
            width: 100%;
        }
    }
</style>
@endsection
