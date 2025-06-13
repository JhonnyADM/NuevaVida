@extends('adminlte::page')

@section('title', 'Registrar Nota de Ingreso')

@section('content_header')
    <h1>Registrar Nota de Ingreso</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('nota_ingreso.store') }}" method="POST" id="formularioNota">
            @csrf

            <div class="form-group">
                <label>Proveedor</label>
                <select name="provedor_id" class="form-control" required>
                    <option value="">Seleccione un proveedor</option>
                    @foreach($provedores as $provedor)
                        <option value="{{ $provedor->id }}">{{ $provedor->descripcion }}</option>
                    @endforeach
                </select>
            </div>

            <hr>
            <h5>Productos</h5>

            <table class="table" id="tabla-productos">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario (Bs)</th>
                        <th>Subtotal (Bs)</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>

            <button type="button" class="btn btn-info mb-3" onclick="agregarProducto()">
                <i class="fas fa-plus-circle"></i> Agregar Producto
            </button>

            <div class="form-group">
                <label><strong>Total General (Bs):</strong></label>
                <input type="text" name="total" id="totalGeneral" class="form-control" readonly>
            </div>

            <button type="submit" class="btn btn-success">Guardar Nota</button>
            <a href="{{ route('nota_ingreso.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>

<script>
    let productos = @json($productos);
    let contador = 0;

    function agregarProducto() {
        const tabla = document.querySelector('#tabla-productos tbody');
        const fila = document.createElement('tr');
        fila.innerHTML = `
            <td>
                <select name="productos[${contador}][producto_id]" class="form-control" onchange="actualizarPrecio(this, ${contador})">
                    <option value="">Seleccione</option>
                    ${productos.map(p => `<option value="${p.id}" data-precio="${p.precio}">${p.nombre}</option>`).join('')}
                </select>
            </td>
            <td><input type="number" name="productos[${contador}][cantidad]" class="form-control" min="1" value="1" oninput="calcularSubtotal(${contador})"></td>
            <td><input type="text" class="form-control" name="productos[${contador}][precio]" readonly></td>
            <td><input type="text" class="form-control subtotal" readonly></td>
            <td><button type="button" class="btn btn-danger btn-sm" onclick="eliminarFila(this)"><i class="fas fa-trash"></i></button></td>
        `;
        tabla.appendChild(fila);
        contador++;
    }

    function actualizarPrecio(select, index) {
        const precio = select.selectedOptions[0].dataset.precio;
        document.querySelector(`input[name="productos[${index}][precio]"]`).value = precio;
        calcularSubtotal(index);
    }

    function calcularSubtotal(index) {
        const cantidad = parseFloat(document.querySelector(`input[name="productos[${index}][cantidad]"]`).value || 0);
        const precio = parseFloat(document.querySelector(`input[name="productos[${index}][precio]"]`).value || 0);
        const subtotal = cantidad * precio;
        document.querySelectorAll('.subtotal')[index].value = subtotal.toFixed(2);
        calcularTotal();
    }

    function calcularTotal() {
        let total = 0;
        document.querySelectorAll('.subtotal').forEach(input => {
            total += parseFloat(input.value || 0);
        });
        document.getElementById('totalGeneral').value = total.toFixed(2);
    }

    function eliminarFila(btn) {
        btn.closest('tr').remove();
        calcularTotal();
    }
</script>
@stop
