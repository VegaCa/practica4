<form action="{{ isset($plantilla) ? route('plantillas.update', $plantilla->id) : route('plantillas.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if(isset($plantilla))
        @method('PUT')
    @endif

    <!-- Mostrar todos los errores al inicio -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-div" style="overflow: hidden">
        <div class="form-div-int">
            <!-- Categoría -->
            <div class="form-group">
                <label for="categoria_id">Categoría:</label>
                <select name="categoria_id" id="categoria_id" class="form-control" required>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}" {{ old('categoria_id', $plantilla->categoria_id ?? '') == $categoria->id ? 'selected' : '' }}>
                            {{ $categoria->nombre }}
                        </option>
                    @endforeach
                </select>
                @error('categoria_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
    
            <!-- Título -->
            <div class="form-group">
                <label for="titulo">Título de la Plantilla:</label>
                <input type="text" name="titulo" id="titulo" class="form-control" value="{{ old('titulo', $plantilla->titulo ?? '') }}" required>
                @error('titulo')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
    
            <!-- Tipo de Catálogo -->
            <div class="form-group">
                <label for="tipo_catalogo">Tipo de Catálogo:</label>
                <select name="tipo_catalogo" id="tipo_catalogo" class="form-control" required>
                    <option value="Con descripcion" {{ old('tipo_catalogo', $plantilla->tipo_catalogo ?? '') == 'Con descripcion' ? 'selected' : '' }}>Con descripción</option>
                    <option value="Sin descripcion" {{ old('tipo_catalogo', $plantilla->tipo_catalogo ?? '') == 'Sin descripcion' ? 'selected' : '' }}>Sin descripción</option>
                </select>
                @error('tipo_catalogo')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
    
            <!-- Precio -->
            <div class="form-group">
                <label for="precio">Precio (opcional):</label>
                <input type="number" name="precio" id="precio" class="form-control" value="{{ old('precio', $plantilla->precio ?? '') }}" step="0.01">
                @error('precio')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
    
            <!-- Número de Vistas -->
            <div class="form-group">
                <label for="numero_vistas">Número de Vistas:</label>
                <input type="number" name="numero_vistas" id="numero_vistas" class="form-control" value="{{ old('numero_vistas', $plantilla->numero_vistas ?? '') }}" required>
                @error('numero_vistas')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
    
            <!-- Enlace -->
            <div class="form-group">
                <label for="enlace">Enlace:</label>
                <input type="url" name="enlace" id="enlace" class="form-control" value="{{ old('enlace', $plantilla->enlace ?? '') }}" required>
                @error('enlace')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
    
            <!-- Descripción -->
            <div class="form-group">
                <label for="descripcion">Descripción (opcional):</label>
                <textarea name="descripcion" id="descripcion" class="form-control">{{ old('descripcion', $plantilla->descripcion ?? '') }}</textarea>
                @error('descripcion')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
    
            <!-- Estado (solo para edición) -->
            @if(isset($plantilla))
                <div class="form-group">
                    <label for="estado">Estado:</label>
                    <select name="estado" id="estado" class="form-control" required>
                        <option value="1" {{ $plantilla->estado == 1 ? 'selected' : '' }}>Activo</option>
                        <option value="0" {{ $plantilla->estado == 0 ? 'selected' : '' }}>Inactivo</option>
                    </select>
                    @error('estado')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            @endif
        </div>
    
        <div class="form-div-int">
            <!-- Imagen Principal -->
            <div class="">
                <div class="d-flex" style="justify-content: space-between; align-items: center">
                    <label for="imagen_1">Imagen Principal</label>
                </div>
    
                <div class="custom-file">
                    <label class="custom-file-label" for="imagen_1" id="label-imagen1">
                        @if(isset($plantilla) && $plantilla->imagen_1)
                            {{ basename($plantilla->imagen_1) }} <!-- Mostrar el nombre de la imagen -->
                        @else
                            Seleccionar Imagen Principal
                        @endif
                    </label>
                    <input type="file" class="custom-file-input" id="imagen_1" name="imagen_1" accept="image/*">
                    @error('imagen_1')
                        <strong class="text-xs text-danger">{{ $message }}</strong>
                    @enderror
                </div>
    
                <!-- Mostrar la imagen existente o una imagen por defecto -->
                <figure class="mt-2 w-50">
                    @if(isset($plantilla) && $plantilla->imagen_1)
                        <img id="preview-imagen1" class="imagenes-preview img-fluid" src="{{ asset($plantilla->imagen_1) }}">
                        <!-- Input oculto para mantener la imagen existente -->
                        <input type="hidden" name="imagen_1_actual" value="{{ $plantilla->imagen_1 }}">
                    @else
                        <img id="preview-imagen1" class="imagenes-preview img-fluid" src="{{ asset('img/image.png') }}">
                    @endif
                </figure>
            </div>
            {{---------------------------}}
            <div class="form-div-int-img">
                <!-- Imagen 2 -->
                <div class="form-div-int-img-int">
                    <div class="d-flex" style="justify-content: space-between; align-items: center">
                        <label for="imagen_2">Imagen 2</label>
                        <input type="hidden" id="imagen2_eliminar" name="imagen2_eliminar" value="0">
                        <button type="button" class="btn btn-danger btn-sm delete-imagen" id="delete-imagen2" style="height: 20px; padding: 3px; display: flex; align-items: center;">X</button>
                    </div>
        
                    <div class="custom-file">
                        <label class="custom-file-label" for="imagen_2" id="label-imagen2">
                            @if(isset($plantilla) && $plantilla->imagen_2)
                                {{ basename($plantilla->imagen_2) }} <!-- Mostrar el nombre de la imagen 2 -->
                            @else
                                Seleccionar Imagen 2
                            @endif
                        </label>
                        <input type="file" class="custom-file-input" id="imagen_2" name="imagen_2" accept="image/*">
                        @error('imagen_2')
                            <strong class="text-xs text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
        
                    <figure class="mt-2 w-50">
                        @if(isset($plantilla) && $plantilla->imagen_2)
                            <img id="preview-imagen2" class="imagenes-preview img-fluid" src="{{ asset($plantilla->imagen_2) }}">
                        @else
                            <img id="preview-imagen2" class="imagenes-preview img-fluid" src="{{ asset('img/image.png') }}">
                        @endif
                    </figure>
                </div>
        
                <!-- Imagen 3 -->
                <div class="form-div-int-img-int">
                    <div class="d-flex" style="justify-content: space-between; align-items: center">
                        <label for="imagen_3">Imagen 3</label>
                        <input type="hidden" id="imagen3_eliminar" name="imagen3_eliminar" value="0">
                        <button type="button" class="btn btn-danger btn-sm delete-imagen" id="delete-imagen3" style="height: 20px; padding: 3px; display: flex; align-items: center;">X</button>
                    </div>
        
                    <div class="custom-file">
                        <label class="custom-file-label" for="imagen_3" id="label-imagen3">
                            @if(isset($plantilla) && $plantilla->imagen_3)
                                {{ basename($plantilla->imagen_3) }} <!-- Mostrar el nombre de la imagen 3 -->
                            @else
                                Seleccionar Imagen 3
                            @endif
                        </label>
                        <input type="file" class="custom-file-input" id="imagen_3" name="imagen_3" accept="image/*">
                        @error('imagen_3')
                            <strong class="text-xs text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
        
                    <figure class="mt-2 w-50">
                        @if(isset($plantilla) && $plantilla->imagen_3)
                            <img id="preview-imagen3" class="imagenes-preview img-fluid" src="{{ asset($plantilla->imagen_3) }}">
                        @else
                            <img id="preview-imagen3" class="imagenes-preview img-fluid" src="{{ asset('img/image.png') }}">
                        @endif
                    </figure>
                </div>
            </div>
            {{---------------------------}}
            <div class="form-div-int-img">
                <!-- Imagen 4 -->
                <div class="form-div-int-img-int">
                    <div class="d-flex" style="justify-content: space-between; align-items: center">
                        <label for="imagen_4">Imagen 4</label>
                        <input type="hidden" id="imagen4_eliminar" name="imagen4_eliminar" value="0">
                        <button type="button" class="btn btn-danger btn-sm delete-imagen" id="delete-imagen4" style="height: 20px; padding: 3px; display: flex; align-items: center;">X</button>
                    </div>
        
                    <div class="custom-file">
                        <label class="custom-file-label" for="imagen_4" id="label-imagen4">
                            @if(isset($plantilla) && $plantilla->imagen_4)
                                {{ basename($plantilla->imagen_4) }} <!-- Mostrar el nombre de la imagen 4 -->
                            @else
                                Seleccionar Imagen 4
                            @endif
                        </label>
                        <input type="file" class="custom-file-input" id="imagen_4" name="imagen_4" accept="image/*">
                        @error('imagen_4')
                            <strong class="text-xs text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
        
                    <figure class="mt-2 w-50">
                        @if(isset($plantilla) && $plantilla->imagen_4)
                            <img id="preview-imagen4" class="imagenes-preview img-fluid" src="{{ asset($plantilla->imagen_4) }}">
                        @else
                            <img id="preview-imagen4" class="imagenes-preview img-fluid" src="{{ asset('img/image.png') }}">
                        @endif
                    </figure>
                </div>
        
                <!-- Imagen 5 -->
                <div class="form-div-int-img-int">
                    <div class="d-flex" style="justify-content: space-between; align-items: center">
                        <label for="imagen_5">Imagen 5</label>
                        <input type="hidden" id="imagen5_eliminar" name="imagen5_eliminar" value="0">
                        <button type="button" class="btn btn-danger btn-sm delete-imagen" id="delete-imagen5" style="height: 20px; padding: 3px; display: flex; align-items: center;">X</button>
                    </div>
        
                    <div class="custom-file">
                        <label class="custom-file-label" for="imagen_5" id="label-imagen5">
                            @if(isset($plantilla) && $plantilla->imagen_5)
                                {{ basename($plantilla->imagen_5) }} <!-- Mostrar el nombre de la imagen 5 -->
                            @else
                                Seleccionar Imagen 5
                            @endif
                        </label>
                        <input type="file" class="custom-file-input" id="imagen_5" name="imagen_5" accept="image/*">
                        @error('imagen_5')
                            <strong class="text-xs text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
        
                    <figure class="mt-2 w-50">
                        @if(isset($plantilla) && $plantilla->imagen_5)
                            <img id="preview-imagen5" class="imagenes-preview img-fluid" src="{{ asset($plantilla->imagen_5) }}">
                        @else
                            <img id="preview-imagen5" class="imagenes-preview img-fluid" src="{{ asset('img/image.png') }}">
                        @endif
                    </figure>
                </div>
            </div>
        </div>
    </div>

    

    <!-- Botón de Guardar o Actualizar -->
    <button type="submit" class="btn btn-success">{{ isset($plantilla) ? 'Actualizar' : 'Guardar' }}</button>
    <a href="{{route('plantillas.index')}}" class="btn btn-secondary">Volver</a>
</form>
