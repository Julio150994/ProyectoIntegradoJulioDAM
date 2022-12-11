@extends('layouts.app')

@section('titulo', 'Ver pedido')

<link rel="stylesheet" href="{{ asset('css/pedidos.css') }}">

{{-- FontAwesome 6.2.0 --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

@section('content')

<h1 class="mt-xs-3 mt-lg-5 mt-md-5 ml-xs-3 ml-lg-4 ml-md-4 mb-xs-2 mb-lg-5 mb-md-5">Detalles de pedido</h1>

<div class="p-xs-2 p-lg-4 p-md-4">
    <div class="container-fluid bg-white p-xs-2 p-lg-3 p-md-3 rounded">
        <a href="{{ route('mozo.pedidos') }}" class="btn btn-dark">
            <span class="fas fa-solid fa-arrow-left"></span>
            <span>Volver a lista de pedidos</span>
        </a>
    </div>
</div>

{{-- Visualizamos el estado del pedido con un color de fondo y fuente diferente --}}
<div class="mt-4 p-xs-2 p-lg-4 p-md-4">
    <strong>Estado de pedido: </strong>

    @switch($estadoPedido)
        @case('Pagado')
            <span class="bg-success text-white ml-xs-1 ml-lg-3 ml-md-3
                pl-xs-1 pl-lg-2 pl-md-2 pr-xs-1 pr-lg-2 pr-md-2 rounded text-center">
                <span class="text-white">{{ $estadoPedido }}</span>
            </span>
            @break
        
        @case('En trámite')
            <span class="bg-primary text-white ml-xs-1 ml-lg-3 ml-md-3
                pl-xs-1 pl-lg-2 pl-md-2 pr-xs-1 pr-lg-2 pr-md-2 rounded text-center">
                <span>{{ $estadoPedido }}</span>
            </span>
            @break
        
        @case('Preparado')
            <span class="bg-amarillo text-white ml-xs-1 ml-lg-3 ml-md-3
                pl-xs-1 pl-lg-2 pl-md-2 pr-xs-1 pr-lg-2 pr-md-2 rounded text-center">
                <span>{{ $estadoPedido }}</span>
            </span>
            @break
        
        @case('Enviado')
            <span class="bg-naranja text-white ml-xs-1 ml-lg-3 ml-md-3
                pl-xs-1 pl-lg-2 pl-md-2 pr-xs-1 pr-lg-2 pr-md-2 rounded text-center">
                <span>{{ $estadoPedido }}</span>
            </span>
            @break

        @case('Incidencia')
            <span class="bg-danger text-white ml-xs-1 ml-lg-3 ml-md-3
                pl-xs-1 pl-lg-2 pl-md-2 pr-xs-1 pr-lg-2 pr-md-2 rounded text-center">
                <span>{{ $estadoPedido }}</span>
            </span>
            @break

        @default

        <span class="bg-secondary text-white ml-xs-1 ml-lg-3 ml-md-3
            pl-xs-1 pl-lg-2 pl-md-2 pr-xs-1 pr-lg-2 pr-md-2 rounded text-center">
            <span>Su pedido no tiene estado</span>
        </span>
    @endswitch
</div>

<div class="row row-cols-lg-2 ml-xs-2 ml-lg-3 ml-md-3 bg-white rounded">
    <table class="table table-bordered text-center m-xs-2 m-lg-5 m-md-5 border border-dark">
        <thead class="table table-primary">
            <tr>
                <th scope="col">Nombre de juego</th>
                <th scope="col">Descripción de juego</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Precio Unitario</th>
            </tr>
        </thead>
        <tbody class="table table-light border border-dark">
            {{-- Contamos cuántos clientes tenemos en Landgame --}}
            @if($detallesPedido->count())
                @foreach ($detallesPedido as $detallePedido)
                    <tr>
                        <td>{{ $detallePedido->juego->nombre }}</td>
                        <td>{{ $detallePedido->juego->descripcion }}</td>
                        <td>{{ $detallePedido->cantidad }}</td>
                        <td>{{ $detallePedido->precioUnitario }} €</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>

@endsection