@extends('adminlte::page')
@section('title', 'Editar Recibo')
@section('content_header')
    <h1>Editar Recibo</h1>
@stop

@section('content')
    <form action="{{ route('solicitar-servicio.update', $recibo->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Mascota --}}
        <div class="form-group">
            <label>Mascota</label>
            <select name="mascota_id" class="form-control">
                @foreach ($mascotas as $mascota)
                    <option value="{{ $mascota->id }}" {{ $recibo->mascota_id == $mascota->id ? 'selected' : '' }}>
                        {{ $mascota->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Promoción --}}
        <div class="form-group">
            <label>Promoción</label>
            <select name="promocion_id" class="form-control" id="promocionSelect">
                <option value="">Sin promoción</option>
                @foreach ($promociones as $promo)
                    <option value="{{ $promo->id }}"
                        {{ optional($recibo->promocion)->id == $promo->id ? 'selected' : '' }}>
                        {{ $promo->nombre }} - Bs {{ $promo->total_a_pagar }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Servicios incluidos en la promoción --}}
        <div id="serviciosPromocion" class="card bg-info p-3 mb-3 text-white">
            <strong>Servicios incluidos en la promoción:</strong>
            <ul id="listaServiciosPromocion">
                @if ($recibo->promocion)
                    @foreach ($recibo->promocion->servicios as $s)
                        <li>✔️ {{ $s->nombre }} - Bs {{ $s->precio }}</li>
                    @endforeach
                @endif
            </ul>
        </div>

        {{-- Servicios Adicionales --}}
        <div class="card card-outline card-secondary mb-3">
            <div class="card-header">Servicios Adicionales</div>
            <div class="card-body" id="contenedorServicios"></div>
            <button type="button" class="btn btn-outline-primary" onclick="agregarServicio()">+ Agregar Servicio</button>
        </div>

        {{-- Productos --}}
        <div class="card card-outline card-secondary mb-3">
            <div class="card-header">Productos Utilizados</div>
            <div class="card-body" id="contenedorProductos"></div>
            <button type="button" class="btn btn-outline-primary" onclick="agregarProducto()">+ Agregar Producto</button>
        </div>

        {{-- Descripción --}}
        <div class="form-group">
            <label>Descripción:</label>
            <textarea class="form-control" name="descripcion">{{ $recibo->descripcion }}</textarea>
        </div>

        {{-- Totales --}}
        <div class="card bg-white shadow-sm p-3 mt-4">
            <div class="card-body">
                <p><strong>Total Promoción:</strong> <span class="badge bg-info text-white">Bs <span id="totalPromo">{{ $recibo->promocion->total_a_pagar ?? 0 }}</span></span></p>
                <p><strong>Total Servicios Adicionales:</strong> <span class="badge bg-primary">Bs <span id="totalServicios">0.00</span></span></p>
                <p><strong>Total Productos:</strong> <span class="badge bg-secondary">Bs <span id="totalProductos">0.00</span></span></p>
                <hr>
                <p class="h5"><strong>Total General:</strong> Bs <span id="totalGeneral">0.00</span></p>
            </div>
        </div>

        <div class="text-end mt-4">
            <button type="submit" class="btn btn-success btn-lg">💾 Guardar Cambios</button>
        </div>
    </form>
@stop

@section('js')
  <script>
        let servicios = @json($servicios);
        let productos = @json($productos);

        // Mostrar servicios incluidos en promoción
        document.getElementById('promocionSelect').addEventListener('change', function() {
            const idPromo = this.value;
            const promo = @json($promociones).find(p => p.id == idPromo);
            const lista = document.getElementById('listaServiciosPromocion');
            lista.innerHTML = '';

            if (promo) {
                promo.servicios.forEach(s => {
                    lista.innerHTML += `<li>✔️ ${s.nombre} - Bs ${s.precio}</li>`;
                });
                document.getElementById('totalPromo').textContent = promo.total_a_pagar;
            } else {
                document.getElementById('totalPromo').textContent = '0.00';
            }
            calcularTotal();
        });

        function agregarServicio(nombre = '', precio = '') {
            let div = document.createElement('div');
            div.classList.add('d-flex', 'mb-2');
            div.innerHTML = `
        <select name="servicios_adicionales[]" class="form-control mr-2 servicioSelect">
            ${servicios.map(s => `<option value="${s.id}" ${s.nombre === nombre ? 'selected' : ''}>${s.nombre} - Bs ${s.precio}</option>`).join('')}
        </select>
        <input type="number" class="form-control mr-2 precioServicio" value="${precio}" readonly>
        <button type="button" class="btn btn-danger" onclick="this.parentNode.remove(); calcularTotal()">🗑</button>
    `;
            document.getElementById('contenedorServicios').appendChild(div);
            actualizarPreciosServicios();
        }

        function actualizarPreciosServicios() {
            document.querySelectorAll('.servicioSelect').forEach(select => {
                select.addEventListener('change', function() {
                    const selected = servicios.find(s => s.id == this.value);
                    this.nextElementSibling.value = selected ? selected.precio : 0;
                    calcularTotal();
                });
            });
        }

        function agregarProducto(productoId = '', cantidad = 1, subtotal = null) {
            let producto = productos.find(p => p.id == productoId);
            let calculado = subtotal !== null ? parseFloat(subtotal).toFixed(2) : producto ? (producto.precio * cantidad)
                .toFixed(2) : '0.00';

            let div = document.createElement('div');
            div.classList.add('d-flex', 'mb-2', 'align-items-center');
            div.innerHTML = `
        <select name="productos[]" class="form-control mr-2 productoSelect">
            ${productos.map(p => `<option value="${p.id}" ${p.id == productoId ? 'selected' : ''}>${p.nombre} - Bs ${p.precio} (Stock: ${p.stock})</option>`).join('')}
        </select>
        <input type="number" name="cantidades[]" class="form-control mr-2 cantidadInput" min="1" value="${cantidad}">
        <input type="number" class="form-control mr-2 subtotalProducto" readonly value="${calculado}">
        <button type="button" class="btn btn-danger" onclick="this.parentNode.remove(); calcularTotal()">🗑</button>
    `;
            document.getElementById('contenedorProductos').appendChild(div);
            actualizarSubtotalesProductos();
        }


        function actualizarSubtotalesProductos() {
            document.querySelectorAll('.productoSelect, .cantidadInput').forEach(elem => {
                elem.addEventListener('change', () => {
                    document.querySelectorAll('#contenedorProductos > div').forEach(row => {
                        const select = row.querySelector('.productoSelect');
                        const cantidad = parseFloat(row.querySelector('.cantidadInput').value) || 1;
                        const producto = productos.find(p => p.id == select.value);
                        row.querySelector('.subtotalProducto').value = (producto.precio * cantidad)
                            .toFixed(2);
                        calcularTotal();
                    });
                });
            });
        }

        function agregarServicio(nombre = '', precio = '') {
            let div = document.createElement('div');
            div.classList.add('d-flex', 'mb-2');
            div.innerHTML = `
        <select name="servicios_adicionales[]" class="form-control mr-2 servicioSelect">
            ${servicios.map(s => `<option value="${s.id}" ${s.nombre === nombre ? 'selected' : ''}>${s.nombre} - Bs ${s.precio}</option>`).join('')}
        </select>
        <input type="number" class="form-control mr-2 precioServicio" value="${precio}" readonly>
        <button type="button" class="btn btn-danger" onclick="this.parentNode.remove(); calcularTotal()">🗑</button>
    `;
            document.getElementById('contenedorServicios').appendChild(div);
            actualizarPreciosServicios();
        }


        function calcularTotal() {
            let totalPromo = parseFloat(document.getElementById('totalPromo').textContent) || 0;
            let totalServicios = 0;
            document.querySelectorAll('.precioServicio').forEach(input => {
                totalServicios += parseFloat(input.value) || 0;
            });

            let totalProductos = 0;
            document.querySelectorAll('.subtotalProducto').forEach(input => {
                totalProductos += parseFloat(input.value) || 0;
            });

            document.getElementById('totalServicios').textContent = totalServicios.toFixed(2);
            document.getElementById('totalProductos').textContent = totalProductos.toFixed(2);
            document.getElementById('totalGeneral').textContent = (totalPromo + totalServicios + totalProductos).toFixed(2);
        }

        window.onload = function() {
            // Precargar servicios adicionales existentes
            @foreach ($recibo->servicios as $servicio)
                agregarServicio('{{ $servicio->nombre }}', '{{ $servicio->precio }}');
            @endforeach

            // Precargar productos utilizados existentes
            @foreach ($recibo->productos as $producto)
                agregarProducto('{{ $producto->id }}', '{{ $producto->pivot->cantidad }}',
                    '{{ $producto->pivot->subtotal }}');
            @endforeach


            calcularTotal();
        };
    </script>

<style>
    .card-header {
        font-weight: bold;
        background-color: #f4f6f9;
        border-bottom: 1px solid #ddd;
    }
    .d-flex > * { flex: 1; }
    .d-flex > .mr-2 { margin-right: 10px; }
    .form-control[readonly] {
        background-color: #e9ecef;
        font-weight: bold;
    }
    .btn-outline-primary { margin-top: 10px; width: 100%; }
    .subtotalProducto, .precioServicio { max-width: 130px; }
    .cantidadInput { max-width: 100px; }
    .productoSelect, .servicioSelect { min-width: 250px; }
    .card.bg-info {
        background: linear-gradient(135deg, #17a2b8, #138496);
        border: none;
    }
    #totalGeneral {
        font-size: 24px;
        font-weight: bold;
        color: #28a745;
    }
</style>
@stop
