@extends('inicio')
@section('titulo', 'Menú del mozo de almacén')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

@section('main_mozo')

<div class="mt-xs-2 mt-lg-3 mt-md-3 ml-xs-2 ml-lg-4 ml-md-4">
    <span class="text-white">Mozo</span>
</div>

<h1 class="mt-xs-3 mt-lg-5 mt-md-5 ml-xs-2 ml-lg-4 ml-md-4
    mb-xs-3 mb-lg-5 mb-md-5">Mozo</h1>

{{-- Mostrar cuando hemos iniciado sesión con usuario mozo --}}
@if (session()->has('login_mozo'))
    <div class="alert alert-primary text-center">
        {{ session()->get('login_mozo') }}
    </div>
@endif


@endsection