@extends('inicio')

@section('titulo', 'Lista de pedidos (contable)')

<link rel="stylesheet" href="{{ asset('css/pedidos.css') }}">

@section('pedidos_contable')

<div class="mt-xs-1 mt-lg-3 mt-md-3 ml-xs-2 ml-lg-4 ml-md-4">
    <span class="text-white">Contable / Pedidos</span>
</div>

<h1 class="mt-xs-3 mt-lg-5 mt-md-5 ml-xs-3 ml-lg-4 ml-md-4 mb-xs-2 mb-lg-5 mb-md-5">Pedidos</h1>

@if(count($pedidos) == 0)
    {{-- Cuando no encontramos pedidos enviados entre dos fechas --}}

    @if($fechaInicio > $fechaFinal)
        <div class="alert alert-danger rounded text-center mt-xs-1 mt-lg-2 mt-md-2 ml-xs-2 ml-lg-4 ml-md-4">
            <span>
                La fecha de inicio ({{ $fechaInicio }}) debe ser menor o igual que la fecha final ({{ $fechaFinal }})
            </span>
        </div>
    @endif

    @if($fechaInicio <= $fechaFinal)
        <div class="alert alert-warning rounded text-center mt-xs-1 mt-lg-2 mt-md-2 ml-xs-2 ml-lg-4 ml-md-4">
            <span>
                No se han encotrado pedidos enviados entre las fechas {{ $fechaInicio }} y {{ $fechaFinal }}
            </span>
        </div> 
    @endif
@endif

@if(count($pedidos) > 0)
    {{-- Mostramos el número total de pedidos --}}
    <div class="bg-info rounded p-xs-2 p-lg-3 p-md-3 mt-xs-2 mt-lg-4 mt-md-4 ml-xs-2 ml-lg-4 ml-md-4">
        <span class="text-white">
            <span>Pedidos enviados encontrados: {!! $pedidos->count() !!}</span>
        </span>
    </div>
@endif

@if (count($pedidos) >= 0)
    <nav class="navbar bg-dark rounded mt-xs-2 mt-lg-4 mt-md-4 ml-xs-2 ml-lg-4 ml-md-4">
        <div class="container-fluid">
            <form action="{{ route('contable.search') }}" class="d-lg-flex d-md-flex" method="POST">
                @csrf

                <span class="text-white">
                    Desde
                    <input type="date" class="navbar-brand form-control" name="fechaInicio" id="fechaInicio"
                        value="fechaInicio" required/>
                </span>
                <span class="text-white ml-xs-4 ml-lg-5 ml-md-5">
                    Hasta
                    <input type="date" class="navbar-brand form-control" name="fechaFinal" id="fechaFinal"
                        value="fechaFinal" required/>
                </span>

                <div class="container-fluid mt-xs-3 mt-lg-4 mt-md-4 d-flex justify-content-end align-content-end">
                    <button class="btn btn-md text-right" id="boton-buscar" type="submit">
                        <span class="fas fa-solid fa-search"></span>
                        <span>Buscar</span>
                    </button>
                </div>

                @foreach ($pedidos as $pedido)
                    {{-- Incluimos la condición de que se muestren los pedidos con estado "Enviado" en Excel --}}
                    @if($fechaInicio != null && $fechaFinal != null && $fechaInicio <= $fechaFinal)
                        <div class="container-fluid mt-xs-3 mt-lg-4 mt-md-4 ml-xs-2 ml-lg-5 ml-md-5 d-lg-flex d-md-flex
                            justify-content-end align-content-end">
                            <a href="{{ route('contable.excel') }}" class="btn btn-success">
                                <span class="fas fa-solid fa-file-excel"></span>
                                <span>Exportar pedidos</span>
                            </a>
                        </div>
                    @endif
                    @break
                @endforeach
            </form>
        </div>
    </nav>

    @if($pedidos->count() > 0)
        {{-- Mostramos la lista de los pedidos que puede visualizar el empleado contable --}}
        <div class="bg-white border border-1 rounded pr-xs-2 pr-lg-4 pr-md-4 pt-xs-1 pt-lg-2 pt-md-2
            pb-xs-1 pb-lg-3 pb-md-3 pl-xs-2 pl-lg-4 pl-md-4
            ml-xs-2 ml-lg-4 ml-md-4 mt-xs-3 mt-lg-5 mt-md-5">
            <table class="table table-bordered text-center mt-3">
                <thead class="table table-info">
                    <tr>
                        <th scope="col">Precio total</th>
                        <th scope="col">Fecha de compra</th>
                        <th scope="col">Estado</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Contamos cuántos pedidos tenemos (el contable puede buscar por datos determinados) --}}
                    @foreach ($pedidos as $pedido)
                        <tr>
                            <td>{{ $pedido->precioTotal }} €</td>
                            <td>{{ date('d/m/y', strtotime($pedido->fechaCompra)) }}</td>
                            <td>{{ $pedido->estado }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endif

@endsection