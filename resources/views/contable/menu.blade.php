@extends('inicio')
@section('titulo', 'Menú del contable')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

@section('main_contable')

<div class="mt-xs-2 mt-lg-3 mt-md-3 ml-xs-2 ml-lg-4 ml-md-4">
    <span class="text-white">Contable</span>
</div>

<h1 class="mt-xs-3 mt-lg-5 mt-md-5 ml-xs-2 ml-lg-4 ml-md-4
    mb-xs-3 mb-lg-5 mb-md-5">Contable</h1>

{{-- Mostrar cuando hemos iniciado sesión con usuario contable --}}
@if (session()->has('login_contable'))
<div class="alert alert-primary text-center">
    {{ session()->get('login_contable') }}
</div>
@endif


@endsection