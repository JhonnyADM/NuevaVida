@extends('adminlte::page')

@section('title', 'Solicitar Servicio')

@section('content_header')
    <h1 class="mb-4">Registrar Atención de Mascota</h1>
@stop

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('solicitar-servicio.store') }}" method="POST"
        onsubmit="this.querySelector('button[type=submit]').disabled = true;">

        @csrf
        <input type="hidden" name="cliente_id" value="{{ $cliente->id }}">
        <input type="hidden" name="atencion_id" value="{{ $atencion->id }}">

        <div class="card">
            <div class="card-body">

                {{-- Selección de Mascota --}}
                <div class="form-group">
                    <label for="mascota_id">Mascota:</label>
                    <select name="mascota_id" id="mascota_id" class="form-control" required>
                        <option value="">Seleccione una mascota</option>
                        @foreach ($mascotas as $mascota)
                            <option value="{{ $mascota->id }}">{{ $mascota->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Sección Servicios --}}
                <div class="mt-4">
                    <label>Servicios Realizados:</label>
                    <div id="servicios-container"></div>
                    <button type="button" class="btn btn-sm btn-outline-primary mt-2" onclick="agregarServicio()">
                        <i class="fas fa-plus-circle"></i> Agregar Servicio
                    </button>
                </div>

                {{-- Sección Productos --}}
                <div class="mt-4">
                    <label>Productos Utilizados:</label>
                    <div id="productos-container"></div>
                    <button type="button" class="btn btn-sm btn-outline-primary mt-2" onclick="agregarProducto()">
                        <i class="fas fa-plus-circle"></i> Agregar Producto
                    </button>
                </div>

                <hr class="mt-4">
                <div class="bg-light p-3 rounded">
                    <p><strong>Total Servicios:</strong> Bs <span id="total-servicios">0.00</span></p>
                    <p><strong>Total Productos:</strong> Bs <span id="total-productos">0.00</span></p>
                    <p class="text-primary"><strong>Total General:</strong> Bs <span id="total-general">0.00</span></p>
                </div>

            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-success" onclick="this.disabled=true; this.form.submit();">
                    <i class="fas fa-save"></i> Registrar Atención
                </button>

            </div>
        </div>
    </form>
@stop

@section('js')
    <script>
        const servicios = @json($servicios);
        const productos = @json($productos);

        let totalServicios = 0;
        let totalProductos = 0;

        function calcularTotales() {
            totalServicios = 0;
            totalProductos = 0;

            // Servicios
            document.querySelectorAll('.servicio-row').forEach(row => {
                const select = row.querySelector('.servicio-select');
                const precio = parseFloat(select.selectedOptions[0]?.dataset.precio || 0);
                totalServicios += precio;
                row.querySelector('.servicio-subtotal').value = precio.toFixed(2);
            });

            // Productos
            document.querySelectorAll('.producto-row').forEach(row => {
                const select = row.querySelector('.producto-select');
                const cantidad = parseInt(row.querySelector('.producto-cantidad').value) || 0;
                const precio = parseFloat(select.selectedOptions[0]?.dataset.precio || 0);
                const subtotal = cantidad * precio;
                totalProductos += subtotal;
                row.querySelector('.producto-subtotal').value = subtotal.toFixed(2);
            });

            document.getElementById('total-servicios').textContent = totalServicios.toFixed(2);
            document.getElementById('total-productos').textContent = totalProductos.toFixed(2);
            document.getElementById('total-general').textContent = (totalServicios + totalProductos).toFixed(2);
        }

        function agregarServicio() {
            const div = document.createElement('div');
            div.className = 'servicio-row mb-2';
            div.innerHTML = `
            <div class="input-group">
                <select name="servicios[]" class="form-control servicio-select" onchange="calcularTotales()">
                    <option value="">Seleccione un servicio</option>
                    ${servicios.map(s => `<option value="${s.id}" data-precio="${s.precio}">${s.nombre} - Bs ${s.precio.toFixed(2)}</option>`).join('')}
                </select>
                <input type="text" class="form-control servicio-subtotal" value="0.00" disabled>
                <div class="input-group-append">
                    <button type="button" class="btn btn-danger" onclick="this.closest('.servicio-row').remove(); calcularTotales()">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        `;
            document.getElementById('servicios-container').appendChild(div);
        }

        function agregarProducto() {
            const div = document.createElement('div');
            div.className = 'producto-row mb-2';
            div.innerHTML = `
            <div class="input-group">
                <select name="productos[]" class="form-control producto-select" onchange="calcularTotales()">
                    <option value="">Seleccione un producto</option>
                    ${productos.map(p => `<option value="${p.id}" data-precio="${p.precio}">${p.nombre} - Bs ${p.precio.toFixed(2)} (Stock: ${p.stock})</option>`).join('')}
                </select>
                <input type="number" min="1" class="form-control producto-cantidad" name="cantidades[]" placeholder="Cantidad" oninput="calcularTotales()">
                <input type="text" class="form-control producto-subtotal" value="0.00" disabled>
                <div class="input-group-append">
                    <button type="button" class="btn btn-danger" onclick="this.closest('.producto-row').remove(); calcularTotales()">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        `;
            document.getElementById('productos-container').appendChild(div);
        }
    </script>
@endsection
