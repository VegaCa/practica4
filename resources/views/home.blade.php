@extends('layouts.main')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
@endsection

@section('content')

{{-- =========== HOME 1 =========== --}}
<div class="header-1">
    <div class="header-1-div contenedor">
        <h1 class="header-1-div-titulo">Presentación de Plantillas Web</h1>
    </div>
</div>

{{-- =========== HOME 2 =========== --}}
<div class="header-2">
    <div class="header-2-div contenedor">
        <div class="header2-div-int">
            <div class="header2-div-int-div">
                <a class="header2-div-int-a" href="{{ route('categorias.index') }}">
                    Guardar Plantilla
                </a>
                <span class="header2-div-int-div-span-1"></span>
                <span class="header2-div-int-div-span-2"></span>
                <span class="header2-div-int-div-span-3"></span>
                <span class="header2-div-int-div-span-4"></span>
            </div>


        </div>
        <div class="header2-div-int">
            <div class="header2-div-int-div">
                <a class="header2-div-int-a" href="{{url('presentacion')}}">
                    Ver Plantillas
                </a>
                <span class="header2-div-int-div-span-1"></span>
                <span class="header2-div-int-div-span-2"></span>
                <span class="header2-div-int-div-span-3"></span>
                <span class="header2-div-int-div-span-4"></span>
            </div>
        </div>
    </div>
</div>

@endsection
