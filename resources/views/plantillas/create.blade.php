@extends('layouts.plantilla')

@section('title', 'Crear Plantilla')

@section('content')

    <h2>Crear Nueva Plantilla</h2>
    @include('plantillas.form', ['plantilla' => null])

@endsection

@push('scripts')
    <script src="{{ asset('js/form.js') }}"></script>
    
    <script>
        var defaultImage = "{{ asset('img/image.png') }}";
    </script>
@endpush
