@extends('layouts.plantilla')

@section('title', 'Plantillas')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Plantillas</h2>
    <a href="{{ route('plantillas.create') }}" class="btn btn-primary">Crear Nueva Plantilla</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Título</th>
            <th>Categoría</th>
            <th>Precio</th>
            <th>N° Vistas</th>
            <th>Estado</th>
            <th>Acción</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($plantillas as $plantilla)
        <tr>
            <td>{{ $plantilla->titulo }}</td>
            <td>{{ $plantilla->categoria->nombre }}</td>
            <td>{{ $plantilla->precio }}</td>
            <td>{{ $plantilla->numero_vistas }}</td>
            <td>
                @if ($plantilla->estado == '1')
                    <span class="item-activado">Activo</span>
                @else
                    <span class="item-inactivo">Inactivo</span>
                @endif
            </td>
            <td>
                <a href="{{ route('plantillas.edit', $plantilla->id) }}" class="btn btn-warning btn-sm">Editar</a>
                <form action="{{ route('plantillas.destroy', $plantilla->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar esta plantilla?');">Borrar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
