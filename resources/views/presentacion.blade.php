@extends('layouts.main')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/presentacion.css')}}">
@endsection

@section('content')

    @livewire('plantilla-filtrada')
@endsection