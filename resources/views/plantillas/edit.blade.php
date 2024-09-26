@extends('layouts.plantilla')

@section('title', 'Editar Plantilla')

@section('content')

<h2>Editar Plantilla</h2>
@include('plantillas.form', ['plantilla' => $plantilla])

@endsection

@push('scripts')
    <script src="{{ asset('js/form.js') }}"></script>
    
    <script>
        var defaultImage = "{{ asset('img/image.png') }}";
    </script>
@endpush
