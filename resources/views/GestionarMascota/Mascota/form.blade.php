<div class="form-group">
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" class="form-control"
           value="{{ old('nombre', $mascota->nombre ?? '') }}" required>
</div>

<div class="form-group">
    <label for="color">Color</label>
    <input type="text" name="color" class="form-control"
           value="{{ old('color', $mascota->color ?? '') }}" required>
</div>

<div class="form-group">
    <label for="descripcion">Descripción</label>
    <input type="text" name="descripcion" class="form-control"
           value="{{ old('descripcion', $mascota->descripcion ?? '') }}" required>
</div>

<div class="form-group">
    <label for="edad">Edad</label>
    <input type="number" name="edad" class="form-control"
           value="{{ old('edad', $mascota->edad ?? '') }}" required>
</div>

<div class="form-group">
    <label for="fecha_nacimiento">Fecha de Nacimiento</label>
    <input type="date" name="fecha_nacimiento" class="form-control"
           value="{{ old('fecha_nacimiento', isset($mascota) ? \Carbon\Carbon::parse($mascota->fecha_nacimiento)->format('Y-m-d') : '') }}" required>
</div>

<div class="form-group">
    <label for="peso">Peso (kg)</label>
    <input type="number" step="0.01" name="peso" class="form-control"
           value="{{ old('peso', $mascota->peso ?? '') }}" required>
</div>

<div class="form-group">
    <label for="raza_id">Raza</label>
    <select name="raza_id" class="form-control" required>
        <option value="">Seleccione una raza</option>
        @foreach ($razas as $raza)
            <option value="{{ $raza->id }}"
                {{ old('raza_id', $mascota->raza_id ?? '') == $raza->id ? 'selected' : '' }}>
                {{ $raza->descripcion }}
            </option>
        @endforeach
    </select>
</div>
