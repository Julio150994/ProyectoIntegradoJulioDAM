@extends('inicio')

@section('titulo', 'Lista de empresas de reparto')

<link rel="stylesheet" href="{{ asset('css/juegos.css') }}">

@section('empresas')

<div class="mt-3 ml-4">
    <span class="text-white">Administración / Empresas de reparto</span>
</div>

<h1 class="mt-5 ml-4 mb-5">Empresas de reparto</h1>

<a href="{{ route('empresas_reparto.create') }}" class="btn btn-success ml-4">
    <span class="fas fa-solid fa-user-plus"></span>
    <span>Añadir empresa</span>
</a>

{{-- Mensaje flash para el CRUD de Empresas de Reparto --}}
@if (session('mensaje_empresa'))
<div class="alert alert-{{ session('mensaje_empresa')[0] }} ml-4 mt-4 mb-1 text-center">
    {{ session('mensaje_empresa')[1] }}
</div>
@endif

{{-- Mostramos el número total de empresas de reparto --}}
<div class="bg-info col-offset-4 ml-4 p-3 mt-4 rounded">
    <span class="text-white">
        <span>Empresas de reparto en total: {!! $empresas->count() !!}</span>
    </span>
</div>

<div class="bg-white border border-1 rounded pl-4 pr-4 pt-2 pb-3 ml-4 mt-4">
    <table class="table table-bordered text-center mt-3">
        <thead class="table table-light">
            <tr>
                <th scope="col">Nombre de empresa</th>
                <th scope="col">Dirección</th>
                <th scope="col">Email</th>
                <th scope="col">Teléfono</th>
                <th scope="col">Imágen</th>
                <th scope="col">Coste Pedido Normal</th>
                <th scope="col">Coste Pedido Urgente</th>
                <th scope="col" colspan="2">Operaciones</th>
            </tr>
        </thead>
        <tbody>
            {{-- Contamos cuántos juegos tenemos en Landgame --}}
            @if($empresas->count())
            @foreach ($empresas as $empresa_reparto)
                <tr>
                    <td>{{ $empresa_reparto->nombre }}</td>
                    <td>{{ $empresa_reparto->direccion }}</td>
                    <td>{{ $empresa_reparto->email }}</td>
                    <td>{{ $empresa_reparto->telefono }}</td>
                    <td>
                        <img class="w-50 h-50" src="{{ asset($empresa_reparto->imagen) }}" loading="lazy" alt="Imágen"
                            data-text="Error al mostrar esta imagen."
                            data-text-short="Error al cargar la imagen"/>
                    </td>
                    <td>{{ $empresa_reparto->coste_pedido_normal }} €</td>
                    <td>{{ $empresa_reparto->coste_pedido_urgente }} €</td>
                    <td>
                        <a href="{{ route('empresas_reparto.edit', $empresa_reparto->id) }}" type="submit" class="btn btn-primary">
                            <span class="fas fa-pencil text-white"></span>
                            <span class="text-white">Editar</span>
                        </a>
                    </td>
                    <td>
                        <button class="btn btn-danger" type="submit" onclick="eliminar('{{ $empresa_reparto->id }}', '{{ $empresa_reparto->nombre }}')">
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
                            <span>Empresas de reparto no encontradas</span>
                        </div>
                    </td>
                </tr>
            @endif
        </tbody>
    </table>

    {{-- Mostramos 5 empresas de reparto por cada paginación --}}
    <div class="pagination pagination-md mt-4">
        {!! $empresas->links() !!}
    </div>
</div>

{{-- Mensaje de confirmación de JS con SweetAlert 2 antes de eliminar la empresa de reparto --}}
<link rel="stylesheet" href="sweetalert2.min.css">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="sweetalert2.min.js"></script>
<script type="text/javascript" src="{{ asset('js/eliminar_empresa_reparto.js') }}"></script>

@endsection