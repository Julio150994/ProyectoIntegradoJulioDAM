@extends('inicio')

@section('titulo', 'Lista de pedidos (mozo de almácen)')

<link rel="stylesheet" href="{{ asset('css/pedidos.css') }}">


@section('pedidos_admin')

<div class="mt-xs-1 mt-lg-3 mt-md-3 ml-xs-2 ml-lg-4 ml-md-4">
    <span class="text-white">Mozo / Pedidos</span>
</div>

<h1 class="mt-xs-3 mt-lg-5 mt-md-5 ml-xs-3 ml-lg-4 ml-md-4 mb-xs-2 mb-lg-5 mb-md-5">Pedidos</h1>

{{-- Mensaje flash para los pedidos --}}
@if (session('mensaje_pedido'))
<div class="alert alert-{{ session('mensaje_pedido')[0] }} ml-4 mt-4 mb-1 text-center">
    {{ session('mensaje_pedido')[1] }}
</div>
@endif

@if(empty($pedidos))
    <div class="alert alert-warning text-center p-xs-2 p-lg-4 p-md-4">
        <span>No se han encontrado pedidos</span>
    </div>
@else
    {{-- Mostramos el número total de pedidos --}}
    <div class="bg-info col-offset-4 ml-4 p-3 mt-4 rounded">
        <span class="text-white">
            <span>Pedidos de Landgame: {!! $pedidos->count() !!}</span>
        </span>
    </div>
@endif

<div class="bg-white ml-4 p-3 mt-5 rounded">
    <table class="table table-bordered text-center mt-3">
        <thead class="table table-light">
            <tr>
                <th scope="col">Precio total</th>
                <th scope="col">Fecha de compra</th>
                <th scope="col">Estado</th>
                <th scope="col" colspan="2">Operaciones</th>
            </tr>
        </thead>
        <tbody>
            {{------- Contamos cuántos pedidos tenemos (el mozo los puede visualizar) -------}}
            @if($pedidos->count())
                @foreach ($pedidos as $pedido)
                    <tr>
                        <td>{{ $pedido->precioTotal }} €</td>
                        <td>{{ date('d/m/y', strtotime($pedido->fechaCompra)) }}</td>
                        <td>{{ $pedido->estado }}</td>
                        <td>
                            {{-- Principalmente ver su estado --}}
                            <a href="{{ route('admin.detalles_pedido', $pedido->id) }}"
                                class="btn btn-warning text-white border border-0" id="boton-ver">
                                <span class="fas fa-solid fa-eye text-white"></span>
                                <span class="text-white">Ver</span>
                            </a>
                        </td>
                        <td>
                            {{-- Solamente modificar su estado --}}
                            @if($pedido->estado == 'Enviado')
                                <button class="btn btn-primary text-white border border-0"
                                    id="boton-modificar" disabled>
                                    <span class="fas fa-solid fa-pencil text-white"></span>
                                    <span>Modificar</span>
                                </button>
                            @else
                                <a href="{{ route('admin.modificar_pedido', $pedido->id) }}"
                                    class="btn btn-primary text-white border border-0" id="boton-modificar">
                                    <span class="fas fa-solid fa-pencil text-white"></span>
                                    <span>Modificar</span>
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>

@endsection
