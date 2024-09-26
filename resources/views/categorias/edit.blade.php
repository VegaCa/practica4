@extends('layouts.plantilla')

@section('title', 'Editar Categoría')

@section('content')
<h2>Editar Categoría</h2>

    @include('categorias.form', ['categoria' => $categoria]) <!-- Incluye el formulario con datos -->

@endsection
