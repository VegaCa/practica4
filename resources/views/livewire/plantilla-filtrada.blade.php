<div class="presentacion-1 contenedor">
    <a class="presentacion-1-volver" href="{{ url('home') }}">Volver</a>

    <div class="presentacion-1-filtros">
        <div class="categoria-div">
            <!-- Acordeón que contiene múltiples filtros -->
            <div class="accordion-cateogiras-div accordion" id="accordionPanelsStayOpenExample" wire:ignore>
                <!-- Acordeón de Categorías -->
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCategories" aria-expanded="true" aria-controls="collapseCategories">
                            Categorías
                        </button>
                    </h2>
                    <div id="collapseCategories" class="accordion-collapse collapse show">
                        <div class="accordion-body">
                            @foreach($categorias as $categoria)
                            <div class="presentacion-1-categorias-div">
                                <button class="presentacion-1-categorias-div-a {{ $selectedCategory == $categoria->id ? 'presentacion-1-categorias-div-a-activo' : '' }}" 
                                    wire:click="setValueCategory({{ $categoria->id }})"
                                    onclick="handleCategoryClick('{{ $categoria->slug }}', {{ $selectedCategory == $categoria->id ? 'true' : 'false' }})">
                                    {{ $categoria->nombre }}
                                </button>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Filtro de Tipo de Catálogo -->
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                            Catálogo
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
                        <div class="accordion-body tipo-catalogo-div">
                            <div class="tipo-catalogo-item">
                                <input type="checkbox" wire:model.live="tipoCatalogo" value="con descripcion"> Con Descripción
                            </div>
                            <div class="tipo-catalogo-item">
                                <input type="checkbox" wire:model.live="tipoCatalogo" value="sin descripcion"> Sin Descripción
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Filtro de Número de Vistas -->
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                            N° de Vistas
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse">
                        <div class="accordion-body tipo-catalogo-div">
                            <div class="tipo-catalogo-item">
                                <input type="checkbox" wire:model.live="numeroVistas" value="4"> 4 Vistas<br>
                            </div>

                            <div class="tipo-catalogo-item">
                                <input type="checkbox" wire:model.live="numeroVistas" value="5"> 5 Vistas<br>
                            </div>

                            <div class="tipo-catalogo-item">
                                <input type="checkbox" wire:model.live="numeroVistas" value="6"> 6 Vistas<br>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Filtro de Precios -->
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFour" aria-expanded="false" aria-controls="panelsStayOpen-collapseFour">
                            Precio
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse">
                        <div class="accordion-body tipo-catalogo-div">
                            <div class="tipo-catalogo-item">
                                <input type="checkbox" wire:model.live="selectedPrices" value="0-200"> 0 - 200 <br>
                            </div>

                            <div class="tipo-catalogo-item">
                                <input type="checkbox" wire:model.live="selectedPrices" value="200-400"> 200 - 400 <br>
                            </div>

                            <div class="tipo-catalogo-item">
                                <input type="checkbox" wire:model.live="selectedPrices" value="400-600"> 400 - 600 <br>
                            </div>

                            <div class="tipo-catalogo-item">
                                <input type="checkbox" wire:model.live="selectedPrices" value="800-1000"> 800 - 1000 <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Mostrar solo plantillas activas cuyas categorías también estén activas -->
        <div class="presentacion-1-plantillas">
            @foreach($plantillas as $plantilla)
                <div class="presentacion-1-plantillas-div">
                    <a href="{{ route('plantilla.detalle', ['categoriaSlug' => $plantilla->categoria->slug, 'plantillaSlug' => $plantilla->slug]) }}" class="presentacion-1-plantillas-div-a">
                        <div class="presentacion-1-plantillas-div-a-img" style="background-image: url('{{ asset($plantilla->imagen_1) }}')"></div>
                        <div class="presentacion-1-plantillas-div-a-int">
                            <h4 class="">{{ $plantilla->titulo }}</h4>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Selecciona todos los botones que necesiten la funcionalidad
        const buttons = document.querySelectorAll('.presentacion-1-categorias-div-a');

        buttons.forEach(button => {
            button.addEventListener('click', function () {
                // Si el botón ya tiene la clase activa, la eliminamos y salimos de la función
                if (this.classList.contains('presentacion-1-categorias-div-a-activo')) {
                    this.classList.remove('presentacion-1-categorias-div-a-activo');
                    return;
                }

                // Remueve la clase 'active-button' de todos los botones
                buttons.forEach(btn => btn.classList.remove('presentacion-1-categorias-div-a-activo'));

                // Agrega la clase 'active-button' al botón que fue clicado
                this.classList.add('presentacion-1-categorias-div-a-activo');
            });
        });
    });
</script>
<script>
    function handleCategoryClick(slug, isRemoving) {
        if (isRemoving === true) {
            history.pushState(null, '', '/presentacion');
        } else {
            history.pushState(null, '', `/presentacion/${slug}`);
        }
    }

    window.addEventListener('popstate', function (event) {
        Livewire.emit('resetCategory');
    });
</script>
