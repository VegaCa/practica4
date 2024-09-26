@extends('layouts.plantilla')

@section('title', 'Crear Categoría')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/categorias.css')}}">
@endsection

@section('content')
    <h2>Crear Nueva Categoría</h2>

    @include('categorias.form', ['categoria' => null]) <!-- Incluye el formulario -->

@endsection
