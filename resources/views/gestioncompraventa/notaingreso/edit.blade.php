@extends('adminlte::page')

@section('title', 'Editar Nota de Ingreso')

@section('content_header')
    <h1>Editar Nota de Ingreso</h1>
@endsection

@section('content')

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<form action="{{ route('nota_ingreso.update', $notas->first()->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="provedor_id">Proveedor</label>
        <select name="provedor_id" id="provedor_id" class="form-control" required>
            @foreach($provedores as $provedor)
                <option value="{{ $provedor->id }}" {{ $provedor->id == $notas->first()->provedor_id ? 'selected' : '' }}>
                    {{ $provedor->descripcion }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="fecha">Fecha</label>
        <input type="date" name="fecha" id="fecha" value="{{ old('fecha', $notas->first()->fecha->format('Y-m-d')) }}" class="form-control" required>
    </div>

    <hr>

    <h4>Productos</h4>
    <div id="productos-container">
        @foreach($notas as $index => $nota)
        <div class="row mb-3 producto-item">
            <input type="hidden" name="nota_id[]" value="{{ $nota->id }}">
            <div class="col-md-6">
                <select name="producto_id[]" class="form-control" required>
                    @foreach($productos as $producto)
                        <option value="{{ $producto->id }}" {{ $producto->id == $nota->producto_id ? 'selected' : '' }}>
                            {{ $producto->nombre }} (Precio: {{ number_format($producto->precio, 2) }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <input type="number" name="cantidad[]" class="form-control cantidad" min="1" value="{{ $nota->cantidad }}" required>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger btn-remove-producto">Eliminar</button>
            </div>
        </div>
        @endforeach
    </div>

    <button type="button" class="btn btn-primary mb-3" id="btn-agregar-producto">Agregar Producto</button>

    <h5>Total: <span id="total">{{ number_format($total, 2) }}</span></h5>

    <button type="submit" class="btn btn-success">Guardar Cambios</button>
</form>

@endsection

@section('js')
<script>
    function calcularTotal() {
        let total = 0;
        const container = document.getElementById('productos-container');
        const productos = @json($productos);

        container.querySelectorAll('.producto-item').forEach(function(item) {
            const select = item.querySelector('select[name="producto_id[]"]');
            const cantidadInput = item.querySelector('input[name="cantidad[]"]');
            const cantidad = parseInt(cantidadInput.value) || 0;
            const producto = productos.find(p => p.id == select.value);

            if(producto && cantidad > 0){
                total += cantidad * producto.precio;
            }
        });

        document.getElementById('total').textContent = total.toFixed(2);
    }

    document.getElementById('productos-container').addEventListener('change', function(e) {
        if(e.target.matches('select[name="producto_id[]"], input[name="cantidad[]"]')) {
            calcularTotal();
        }
    });

    document.getElementById('btn-agregar-producto').addEventListener('click', function() {
        const container = document.getElementById('productos-container');
        const productos = @json($productos);

        const div = document.createElement('div');
        div.classList.add('row', 'mb-3', 'producto-item');

        div.innerHTML = `
            <input type="hidden" name="nota_id[]" value="">
            <div class="col-md-6">
                <select name="producto_id[]" class="form-control" required>
                    ${productos.map(p => `<option value="${p.id}">${p.nombre} (Precio: ${p.precio.toFixed(2)})</option>`).join('')}
                </select>
            </div>
            <div class="col-md-4">
                <input type="number" name="cantidad[]" class="form-control cantidad" min="1" value="1" required>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger btn-remove-producto">Eliminar</button>
            </div>
        `;

        container.appendChild(div);
        calcularTotal();
    });

    document.getElementById('productos-container').addEventListener('click', function(e) {
        if(e.target.classList.contains('btn-remove-producto')) {
            e.target.closest('.producto-item').remove();
            calcularTotal();
        }
    });

    // Calcular total inicial
    calcularTotal();
</script>
@endsection

