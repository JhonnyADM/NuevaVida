@extends('adminlte::page')

@section('content')
    <div class="container">
        <h2>Registrar Personal</h2>
        <form action="{{ route('personal.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Nombre</label>
                <input type="text" name="nombre" class="form-control">
            </div>

            <div class="form-group">
                <label>Apellido</label>
                <input type="text" name="apellido" class="form-control">
            </div>
            <div class="form-group">
                <label>Teléfono</label>
                <input type="text" name="telefono" class="form-control">
            </div>

            <div class="form-group">
                <label>Tipo de Personal</label>
                <select name="tipo" id="tipo" class="form-control">
                    <option value="">Seleccione</option>
                    <option value="cliente">Cliente</option>
                    <option value="pasante">Pasante</option>
                    <option value="atencion">Atención</option>
                    <option value="voluntario">Voluntario</option>
                    <option value="veterinario">Veterinario</option>
                </select>
            </div>

            <!-- Campos específicos por tipo -->
            <div id="campos_cliente" class="tipo-campos d-none">
                <div class="form-group">
                    <label>Celular</label>
                    <input type="text" name="celular" class="form-control">
                </div>
                <div class="form-group">
                    <label>Dirección</label>
                    <input type="text" name="direccion_cliente" class="form-control">
                </div>
            </div>

            <div id="campos_pasante" class="tipo-campos d-none">
                <div class="form-group">
                    <label>Inicio</label>
                    <input type="date" name="inicio" class="form-control">
                </div>
                <div class="form-group">
                    <label>Fin</label>
                    <input type="date" name="fin" class="form-control">
                </div>
            </div>

            <div id="campos_atencion" class="tipo-campos d-none">
                <div class="form-group">
                    <label>Cargo</label>
                    <input type="text" name="cargo" class="form-control">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email_atencion" class="form-control">
                </div>
            </div>

            <div id="campos_voluntario" class="tipo-campos d-none">
                <div class="form-group">
                    <label>Dirección</label>
                    <input type="text" name="direccion_voluntario" class="form-control">
                </div>
                <div class="form-group">
                    <label>Edad</label>
                    <input type="number" name="edad" class="form-control">
                </div>
            </div>

            <div id="campos_veterinario" class="tipo-campos d-none">
                <div class="form-group">
                    <label>Profesión</label>
                    <input type="text" name="profesion" class="form-control">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email_veterinario" class="form-control">
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
@endsection

@section('js')
    <script>
        document.getElementById('tipo').addEventListener('change', function() {
            const tipos = ['cliente', 'pasante', 'atencion', 'voluntario', 'veterinario'];

            tipos.forEach(tipo => {
                document.getElementById('campos_' + tipo).classList.add('d-none');
            });

            const tipoSeleccionado = this.value;
            if (tipoSeleccionado && tipos.includes(tipoSeleccionado)) {
                document.getElementById('campos_' + tipoSeleccionado).classList.remove('d-none');
            }
        });
    </script>
@endsection
