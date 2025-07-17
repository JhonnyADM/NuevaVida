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

    <form action="{{ route('solicitar-servicio.store') }}" method="POST" onsubmit="this.querySelector('button[type=submit]').disabled = true;">
        @csrf
        <input type="hidden" name="cliente_id" value="{{ $cliente->id }}">
        <input type="hidden" name="atencion_id" value="{{ $atencion->id }}">

        <div class="card">
            <div class="card-body">
                {{-- Mascota --}}
                <div class="form-group">
                    <label for="mascota_id">Mascota:</label>
                    <select name="mascota_id" id="mascota_id" class="form-control" required>
                        <option value="">Seleccione una mascota</option>
                        @foreach ($mascotas as $mascota)
                            <option value="{{ $mascota->id }}">{{ $mascota->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Promoción --}}
                <div class="form-group mt-4">
                    <label for="promocion_id">Promoción:</label>
                    <select name="promocion_id" id="promocion_id" class="form-control" onchange="mostrarServiciosPromocion(); calcularTotales()">
                        <option value="">Seleccione una promoción</option>
                        @foreach ($promociones as $promo)
                            <option value="{{ $promo->id }}" data-servicios='@json($promo->servicios)' data-total="{{ $promo->total_a_pagar }}">
                                {{ $promo->nombre }} ({{ $promo->porcentaje_descuento }}% desc.)
                            </option>
                        @endforeach
                    </select>
                </div>

                <div id="promocion-detalle" class="bg-info text-white p-3 rounded d-none">
                    <p class="mb-1"><i class="fas fa-tags"></i> <strong>Servicios incluidos en la promoción:</strong></p>
                    <ul id="lista-servicios-promocion" class="mb-0 pl-3"></ul>
                </div>

                {{-- Servicios --}}
                <div class="mt-4 mb-4">
                    <label>Servicios Realizados:</label>
                    <div id="servicios-container" class="mb-2"></div>
                    <button type="button" class="btn btn-outline-primary btn-sm" onclick="agregarServicio()">
                        <i class="fas fa-plus-circle"></i> Agregar Servicio
                    </button>
                </div>

                {{-- Productos --}}
                <div class="mb-4">
                    <label>Productos Utilizados:</label>
                    <div id="productos-container" class="mb-2"></div>
                    <button type="button" class="btn btn-outline-primary btn-sm" onclick="agregarProducto()">
                        <i class="fas fa-plus-circle"></i> Agregar Producto
                    </button>
                </div>

                {{-- Descripción --}}
                <div class="form-group">
                    <label for="descripcion">Descripción:</label>
                    <textarea name="descripcion" id="descripcion" class="form-control @error('descripcion') is-invalid @enderror" rows="3">{{ old('descripcion') }}</textarea>
                    @error('descripcion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Totales --}}
                <hr class="mt-4">
                <div class="bg-light p-3 rounded">
                    <p><strong>Total Promoción:</strong> Bs <span id="total-promocion">0.00</span></p>
                    <p><strong>Total Servicios Adicionales:</strong> Bs <span id="total-servicios">0.00</span></p>
                    <p><strong>Total Productos:</strong> Bs <span id="total-productos">0.00</span></p>
                    <p class="text-primary"><strong>Total General:</strong> Bs <span id="total-general">0.00</span></p>
                </div>

            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-success">
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
    const promociones = @json($promociones);

    let totalServicios = 0;
    let totalProductos = 0;
    let totalPromocion = 0;

    function calcularTotales() {
        totalServicios = 0;
        totalProductos = 0;
        totalPromocion = 0;

        // Servicios adicionales
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

        // Promoción
        const promocionSelect = document.getElementById('promocion_id');
        totalPromocion = parseFloat(promocionSelect.selectedOptions[0]?.dataset.total || 0);

        document.getElementById('total-promocion').textContent = totalPromocion.toFixed(2);
        document.getElementById('total-servicios').textContent = totalServicios.toFixed(2);
        document.getElementById('total-productos').textContent = totalProductos.toFixed(2);
        document.getElementById('total-general').textContent = (totalServicios + totalProductos + totalPromocion).toFixed(2);
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

    function mostrarServiciosPromocion() {
        const select = document.getElementById('promocion_id');
        const selected = select.selectedOptions[0];
        const servicios = selected?.dataset.servicios ? JSON.parse(selected.dataset.servicios) : [];

        const lista = document.getElementById('lista-servicios-promocion');
        lista.innerHTML = '';

        if (servicios.length > 0) {
            servicios.forEach(s => {
                lista.innerHTML += `<li><i class="fas fa-check-circle text-success"></i> ${s.nombre} - Bs ${parseFloat(s.precio).toFixed(2)}</li>`;
            });
            document.getElementById('promocion-detalle').classList.remove('d-none');
        } else {
            document.getElementById('promocion-detalle').classList.add('d-none');
        }
    }
</script>
@endsection
