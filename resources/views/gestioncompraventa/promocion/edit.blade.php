@extends('adminlte::page')

@section('title', 'Editar Promoción')

@section('content_header')
    <h1 class="text-warning">Editar Promoción</h1>
@stop

@section('content')
<div class="card shadow">
    <div class="card-header bg-warning text-white">
        <strong><i class="fas fa-edit"></i> Actualizar Datos</strong>
    </div>

    <div class="card-body">
        <form action="{{ route('promociones.update', $promocion->id) }}" method="POST" id="form-promocion">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Nombre</label>
                <x-adminlte-input name="nombre" value="{{ $promocion->nombre }}" required />
            </div>

            <div class="form-group">
                <label>Detalle</label>
                <x-adminlte-textarea name="detalle" rows="2">{{ $promocion->detalle }}</x-adminlte-textarea>
            </div>

            <div class="form-row mb-3">
                <div class="col-md-6">
                    <label>Fecha de inicio</label>
                    <x-adminlte-input name="fecha_inicio" type="date" value="{{ $promocion->fecha_inicio }}" required />
                </div>
                <div class="col-md-6">
                    <label>Fecha de finalización</label>
                    <x-adminlte-input name="fecha_fin" type="date" value="{{ $promocion->fecha_fin }}" required />
                </div>
            </div>

            <div class="form-group">
                <label>Estado</label>
                <x-adminlte-select name="estado">
                    <option value="activo" {{ $promocion->estado == 'activo' ? 'selected' : '' }}>Activo</option>
                    <option value="inactivo" {{ $promocion->estado == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                </x-adminlte-select>
            </div>

            {{-- SERVICIOS --}}
            <div class="form-group">
                <label class="font-weight-bold">Servicios Realizados:</label>
                <div id="servicios-container"></div>

                <button type="button" class="btn btn-outline-primary mt-2" onclick="agregarServicio()">
                    <i class="fas fa-plus-circle"></i> Agregar Servicio
                </button>
            </div>

            <div class="form-group mt-3">
                <label>Descuento (%)</label>
                <x-adminlte-input name="descuento" id="descuento" value="{{ $promocion->descuento }}" type="number" step="0.01" required />
            </div>

            <div class="row">
                <div class="col-md-6">
                    <x-adminlte-input name="total_precio" id="total_precio" label="Total sin descuento (Bs)" value="{{ $promocion->total_precio }}" readonly />
                </div>
                <div class="col-md-6">
                    <x-adminlte-input name="total_a_pagar" id="total_a_pagar" label="Total con descuento (Bs)" value="{{ $promocion->total_a_pagar }}" readonly />
                </div>
            </div>

            <div class="d-flex justify-content-end mt-4">
                <x-adminlte-button label="Actualizar" theme="success" icon="fas fa-sync-alt" type="submit" />
                <a href="{{ route('promociones.index') }}" class="btn btn-secondary ml-2">
                    <i class="fas fa-arrow-left"></i> Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@stop

@section('js')
<script>
    const serviciosData = @json($servicios);
    const seleccionados = @json($promocion->servicios->pluck('id')->toArray());
    const contenedor = document.getElementById('servicios-container');

    function agregarServicio(idSeleccionado = null) {
        const row = document.createElement('div');
        row.className = 'input-group mb-2 servicio-row';

        const select = document.createElement('select');
        select.name = 'servicios[]';
        select.className = 'form-select form-control';
        select.required = true;

        const defaultOption = document.createElement('option');
        defaultOption.text = 'Seleccione un servicio';
        defaultOption.disabled = true;
        defaultOption.selected = !idSeleccionado;
        select.appendChild(defaultOption);

        serviciosData.forEach(servicio => {
            const option = document.createElement('option');
            option.value = servicio.id;
            option.dataset.precio = servicio.precio;
            option.text = servicio.nombre;
            if (idSeleccionado == servicio.id) option.selected = true;
            select.appendChild(option);
        });

        const precioInput = document.createElement('input');
        precioInput.className = 'form-control bg-light text-center';
        precioInput.readOnly = true;
        precioInput.value = '0.00';

        const btnRemove = document.createElement('button');
        btnRemove.type = 'button';
        btnRemove.className = 'btn btn-danger';
        btnRemove.innerHTML = '<i class="fas fa-trash-alt"></i>';
        btnRemove.onclick = () => {
            row.remove();
            calcularTotales();
        };

        select.addEventListener('change', () => {
            const precio = parseFloat(select.options[select.selectedIndex].dataset.precio || 0);
            precioInput.value = precio.toFixed(2);
            calcularTotales();
        });

        row.appendChild(select);
        row.appendChild(precioInput);
        row.appendChild(btnRemove);
        contenedor.appendChild(row);

        if (idSeleccionado) {
            const precio = parseFloat(select.options[select.selectedIndex].dataset.precio || 0);
            precioInput.value = precio.toFixed(2);
        }
    }

    function calcularTotales() {
        let total = 0;
        document.querySelectorAll('.servicio-row input').forEach(input => {
            total += parseFloat(input.value || 0);
        });

        const descuento = parseFloat(document.getElementById('descuento')?.value || 0);
        const totalFinal = total - (total * (descuento / 100));

        document.getElementById('total_precio').value = total.toFixed(2);
        document.getElementById('total_a_pagar').value = totalFinal.toFixed(2);
    }

    // Inicializar servicios ya seleccionados
    window.onload = () => {
        seleccionados.forEach(id => agregarServicio(id));
        calcularTotales();
    }

    document.getElementById('descuento')?.addEventListener('input', calcularTotales);
</script>
@endsection
