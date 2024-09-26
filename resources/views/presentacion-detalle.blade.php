@extends('layouts.main')

@section('styles')
<link rel="stylesheet" href="{{asset('css/presentacion-detalle.css')}}">
@endsection

@section('content')

<!-- Loader -->
<div id="loader" class="loader">
    <p>Cargando...</p>
</div>

<div class="presentacion-detalle-principal">
    <div class="contenedor presentacion-detalle">
        <div class="presentacion-detalle-img">
            <!-- Carrusel de Imágenes -->
            <div id="carouselExampleFade" class="div-imagenes carousel slide carousel-fade">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="img-detalle" style="background-image: url({{ asset($plantilla->imagen_1) }})"></div>
                    </div>
    
                    @isset($plantilla->imagen_2)
                    <div class="carousel-item">
                        <div class="img-detalle" style="background-image: url({{ asset($plantilla->imagen_2) }})"></div>
                    </div>
                    @endisset
    
                    @isset($plantilla->imagen_3)
                    <div class="carousel-item">
                        <div class="img-detalle" style="background-image: url({{ asset($plantilla->imagen_3) }})"></div>
                    </div>
                    @endisset
    
                    @isset($plantilla->imagen_4)
                    <div class="carousel-item">
                        <div class="img-detalle" style="background-image: url({{ asset($plantilla->imagen_4) }})"></div>
                    </div>
                    @endisset
    
                    @isset($plantilla->imagen_5)
                    <div class="carousel-item">
                        <div class="img-detalle" style="background-image: url({{ asset($plantilla->imagen_5) }})"></div>
                    </div>
                    @endisset
                </div>
            </div>
            
            <!-- Indicadores del Carrusel -->
            <div class="indicadores-carucel">
                <button type="button" data-bs-target="#carouselExampleFade" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1" style="background-image: url({{ asset($plantilla->imagen_1) }})"></button>
                @isset($plantilla->imagen_2)
                    <button type="button" data-bs-target="#carouselExampleFade" data-bs-slide-to="1" aria-label="Slide 2" style="background-image: url({{ asset($plantilla->imagen_2) }})"></button>
                @endisset
                @isset($plantilla->imagen_3)
                    <button type="button" data-bs-target="#carouselExampleFade" data-bs-slide-to="2" aria-label="Slide 3" style="background-image: url({{ asset($plantilla->imagen_3) }})"></button>
                @endisset
                @isset($plantilla->imagen_4)
                    <button type="button" data-bs-target="#carouselExampleFade" data-bs-slide-to="3" aria-label="Slide 4" style="background-image: url({{ asset($plantilla->imagen_4) }})"></button>
                @endisset
                @isset($plantilla->imagen_5)
                    <button type="button" data-bs-target="#carouselExampleFade" data-bs-slide-to="4" aria-label="Slide 5" style="background-image: url({{ asset($plantilla->imagen_5) }})"></button>
                @endisset
            </div>
        </div>
    
        <!-- Información de la Plantilla -->
        <div class="presentacion-detalle-informacion">
            <h2>{{ $plantilla->titulo }}</h2>
            <!-- Mostrar Descripción si existe -->
            @if(!empty($plantilla->descripcion))
                <p>{{ $plantilla->descripcion }}</p>
            @endif
            <!-- Mostrar Precio si existe -->
            @if(!empty($plantilla->precio))
                <p><strong>Precio:</strong> ${{ $plantilla->precio }}</p>
            @endif
            <p><strong>Número de Vistas:</strong> {{ $plantilla->numero_vistas }}</p>
            <p><strong>Tipo de Catálogo:</strong> {{ $plantilla->tipo_catalogo }}</p>
            <div class="information-btn-div">
                <a href="{{ $plantilla->enlace }}" class="informacion-btn btn btn-primary">Ir a ver</a>
                <a href="{{url('presentacion')}}" class="informacion-btn btn btn-secondary">Volver</a>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const buttons = document.querySelectorAll('.indicadores-carucel button');

        buttons.forEach(button => {
            button.addEventListener('click', function() {
                buttons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
            });
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Lista de todas las imágenes que deben precargarse
        const imagesToPreload = [
            "{{ asset($plantilla->imagen_1) }}",
            "{{ asset($plantilla->imagen_2 ?? asset($plantilla->imagen_1)) }}",
            "{{ asset($plantilla->imagen_3 ?? asset($plantilla->imagen_1)) }}",
            "{{ asset($plantilla->imagen_4 ?? asset($plantilla->imagen_1)) }}",
            "{{ asset($plantilla->imagen_5 ?? asset($plantilla->imagen_1)) }}"
        ];

        let loadedImages = 0; // Contador para verificar la carga de todas las imágenes

        // Pre-cargar cada imagen
        imagesToPreload.forEach(function (src) {
            if (src) {
                const img = new Image();
                img.src = src;
                img.onload = function () {
                    loadedImages++;
                    if (loadedImages === imagesToPreload.length) {
                        document.getElementById('loader').classList.add('hidden'); // Ocultar el loader cuando todas las imágenes estén cargadas
                    }
                };
            }
        });
    });
</script>
@endpush
