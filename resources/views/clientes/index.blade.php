@extends('inicio')

@section('titulo', 'Listado de clientes')

<link rel="stylesheet" href="{{ asset('css/cliente.css') }}">

@section('usuarios_landgame')

<div class="mt-3 ml-4">
    <span class="text-white">Administración / Clientes</span>
</div>

<h1 class="mt-5 ml-4 mb-5">Clientes</h1>

<a href="{{ route('clientes.create') }}" class="btn btn-success ml-4">
    <span class="fas fa-solid fa-user-plus"></span>
    <span>Añadir cliente</span>
</a>

{{-- Mensaje flash para el CRUD Clientes --}}
@if (session('mensaje_cliente'))
<div class="alert alert-{{ session('mensaje_cliente')[0] }} ml-4 mt-4 mb-1 text-center">
    {{ session('mensaje_cliente')[1] }}
</div>
@endif

{{-- Mostramos el número total de clientes --}}
<div class="bg-info col-offset-4 ml-4 p-3 mt-4 rounded">
    <span class="text-white">
        <span>Clientes en total: {!! $clientes->count() !!}</span>
    </span>
</div>

<div class="bg-white border border-1 rounded pl-4 pr-4 pt-2 pb-3 ml-4 mt-4">
    <table class="table table-bordered text-center mt-3">
        <thead class="table table-light">
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Apellidos</th>
                <th scope="col">Email</th>
                <th scope="col">Nombre de usuario</th>
                <th scope="col" colspan="2">Operaciones</th>
            </tr>
        </thead>
        <tbody>
            {{-- Contamos cuántos clientes tenemos en Landgame --}}
            @if($clientes->count())
            @foreach ($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->nombre }}</td>
                    <td>{{ $cliente->apellidos }}</td>
                    <td>{{ $cliente->email }}</td>
                    <td>{{ $cliente->username }}</td>
                    <td>
                        <a href="{{ route('clientes.edit', $cliente->id) }}" type="submit" class="btn btn-primary">
                            <span class="fas fa-pencil text-white"></span>
                            <span class="text-white">Editar</span>
                        </a>
                    </td>
                    <td>
                        <button class="btn btn-danger" type="submit" onclick="eliminar('{{ $cliente->id }}', '{{ $cliente->username }}')">
                            <span class="fas fa-solid fa-trash-can"></span>
                            <span>Eliminar</span>
                        </button>
                    </td>
                </tr>
            @endforeach
            @else
                <tr>
                    <td colspan="6">
                        <div class="alert alert-warning">
                            <span>Clientes no encontrados en Landgame</span>
                        </div>
                    </td>
                </tr>
            @endif
        </tbody>
    </table>

    {{-- Mostramos 5 clientes por cada paginación --}}
    <div class="pagination pagination-md mt-4">
        {!! $clientes->links() !!}
    </div>
</div>

{{-- Mensaje de confirmación de JS con SweetAlert 2 antes de eliminar cliente --}}
<link rel="stylesheet" href="sweetalert2.min.css">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="sweetalert2.min.js"></script>
<script type="text/javascript" src="{{ asset('js/eliminar_cliente.js') }}"></script>

@endsection