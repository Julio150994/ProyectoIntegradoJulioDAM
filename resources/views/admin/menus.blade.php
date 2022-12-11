@extends('inicio')
@section('titulo', 'Menus de administrador')

<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

@section('menus')

{{-- Cuerpo de los menus de administración --}}
<div class="mt-3 ml-4">
    <span class="text-white">Administración / Menus</span>
</div>

<h1 class="mt-5 ml-4 mb-5">Menus</h1>

<button class="btn btn-white text-white">
    <span class="fas fa-solid fa-circle-plus text-primary"></span>
    <span>Añadir nuevo menú</span>
</button>

<button class="btn btn-white text-white">
    <span class="fas fa-solid fa-circle-question text-primary"></span>
    <span>Ayuda</span>
</button>

@endsection