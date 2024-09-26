@extends('layouts.plantilla')

@section('title', 'Categorías')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/categorias.css')}}">
@endsection


@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Categorías</h2>
    <a href="{{ route('categorias.create') }}" class="btn btn-primary">Crear Nueva Categoría</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Estado</th>
            <th>Acción</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categorias as $categoria)
        <tr>
            <td>{{ $categoria->nombre }}</td>
            <td>
                @if ($categoria->estado == '1')
                    <span class="item-activado">Activo</span>
                @else
                    <span class="item-inactivo">Inactivo</span>
                @endif
            </td>
            <td>
                <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-warning btn-sm">Editar</a>
                <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar esta categoría?');">Borrar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
