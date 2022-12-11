@extends('inicio')

@section('titulo', 'Página inicial del administrador')

<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

@section('main_admin')
{{-- Cuerpo de la página inicial de administración --}}

<div class="mt-3 ml-4">
    <span class="text-white">Administración</span>
</div>

<h1 class="mt-5 ml-4 mb-5">Administración</h1>

{{-- Mensaje después de iniciar sesión con el administrador --}}
@if (session()->has('login_admin'))
<div class="alert alert-primary text-center">
    {{ session()->get('login_admin') }}
</div>
@endif

@endsection