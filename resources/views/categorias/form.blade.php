<form action="{{ isset($categoria) ? route('categorias.update', $categoria->id) : route('categorias.store') }}" method="POST">
    @csrf
    @if(isset($categoria))
        @method('PUT')
    @endif
    <div class="form-group">
        <label for="nombre">Nombre de la Categoría:</label>
        <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $categoria->nombre ?? '') }}" required>
    </div>

    <!-- Estado (solo para edición) -->
    @if(isset($categoria))
        <div class="form-group">
            <label for="estado">Estado:</label>
            <select name="estado" id="estado" class="form-control" required>
                <option value="1" {{ $categoria->estado == 1 ? 'selected' : '' }}>Activo</option>
                <option value="0" {{ $categoria->estado == 0 ? 'selected' : '' }}>Inactivo</option>
            </select>
            @error('estado')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    @endif

    <button type="submit" class="btn btn-success">{{ isset($categoria) ? 'Actualizar' : 'Guardar' }}</button>
    <a href="{{route('categorias.index')}}" class="btn btn-secondary">Volver</a>
</form>
