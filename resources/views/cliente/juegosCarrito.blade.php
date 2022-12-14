@extends('layouts.app')

@section('titulo', 'Juegos del carrito mostrados')

{{-- CSS Bootstrap 5 --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<link rel="stylesheet" href="{{ asset('css/carrito.css') }}">

{{-- FontAwesome 6.2.0 --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">


@section('content')
{{-- Reutilizamos nuestro header como componente --}}
<x-header/>

<div class="container_compras">
    <h2 class="text-center text-white">Carrito de la compra de {{ Auth::user()->username }}</h2>

    {{-- Mensaje flash para indicar que hemos comprado todos los juegos que tenemos en el carrito --}}
    @if (session('mensaje_compra'))
    <div class="m-xs-2 m-lg-5 m-md-5">
        <div class="alert alert-{{ session('mensaje_compra')[0] }} text-center p-xs-2 p-lg-4 p-md-4">
            {{ session('mensaje_compra')[1] }}
        </div>
    </div>
    @endif

    {{-- Mensaje en caso de que el cliente haya cancelado el pago --}}
    @if(session('paymentStatus'))
        <div class="m-xs-2 m-lg-5 m-md-5">
            <div class="alert alert-{{ session('paymentStatus')[0] }} text-center p-xs-2 p-lg-4 p-md-4">
                {{ session('paymentStatus')[1] }}
            </div>
        </div>
    @endif

    @if(!empty($juegoCarrito))
        <div class="bg-primary m-xs-2 m-lg-5 m-md-5 p-xs-3 p-lg-3 p-md-3 rounded">
            <span class="text-white ml-lg-2 ml-xs-2 ml-md-2">
                <span>Juegos en carrito: {{ count($juegoCarrito) }}</span>
            </span>
        </div>
    @endif

    <div class="m-xs-2 m-lg-5 m-md-5">
        @if(empty($juegoCarrito))
            <div class="alert alert-warning text-center p-xs-2 p-lg-4 p-md-4">
                <span>{{ Auth::user()->username }} no tiene juegos en su carrito</span>
            </div>
        @else
            <div class="container-fluid bg-white border border-1 rounded justify-content-center ml-xs-2 pt-xs-3 pt-lg-3 pt-md-3">
                <table class="table table-bordered text-center">
                    <thead class="table table-secondary">
                        <tr>
                            <th scope="col">Nombre del juego</th>
                            <th scope="col">Descripción del juego</th>
                            <th scope="col">Imágen del juego</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Precio Unitario</th>
                            <th scope="col">Eliminar del carrito</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($juegoCarrito) > 0)
                            @foreach($juegoCarrito as $juego)
                                <tr>
                                    <td>{{ $juego['nombre'] }}</td>
                                    <td>{{ $juego['descripcion'] }}</td>
                                    <td>
                                        <div class="bg-light rounded">
                                            <img class="img-fluid w-25 h-25" loading="lazy" src="{{ asset($juego['imagen']) }}" draggable="false"
                                                decoding="async" alt="Juego de Landgame" data-text="Error al mostrar esta imagen."
                                                data-text-short="No se pudo cargar la imagen"/>
                                        </div>
                                    </td>
                                    <td>{{ $juego['cantidad'] }}</td>
                                    <td>{{ $juego['precioUnitario'] }} €</td>
                                   <td>
                                        <button class="btn btn-danger" onclick="eliminar('{{ $juego['juegoId'] }}', '{{ $juego['nombre'] }}')">
                                            <span class="fas fa-solid fa-trash-can"></span>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        @endif

        <div class="row mt-xs-3 mt-lg-5 mt-md-5">
            <div class="col-xs-6 col-lg-2 col-md-2">
                <a href="{{ route('menu_tienda') }}" class="btn btn-md btn-block border btn-info border-0 text-white">
                    <span class="fas fa-solid fa-arrow-left"></span>
                    <span>Volver al menú</span>
                </a>
            </div>

            @if(!empty($juegoCarrito))
                <div class="col-xs-6 col-lg-2 col-md-2">
                    <button class="btn btn-md btn-block border btn-danger border-0" onclick="limpiar()">
                        <span class="fas fa-solid fa-trash"></span>
                        <span>Limpiar carrito</span>
                    </button>
                </div>

                {{-- Nos redirige a la página de nuestro diseño PayPal --}}
                <div class="col-xs-6 col-lg-2 col-md-2">
                    <form action="{{ route('cliente.compra') }}" method="GET">

                        <button type="submit" class="btn btn-md btn-block border btn-success border-0">
                            <span class="fas fa-solid fa-cart-shopping"></span>
                            <span>Comprar juegos</span>
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>

{{-- Aquí mostramos el footer como otro componente --}}
<x-footer/>

{{-- Mensajes de confirmación para eliminar juegos del carrito y/o limpiarlo --}}
<link rel="stylesheet" href="sweetalert2.min.css">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="sweetalert2.min.js"></script>
<script type="text/javascript" src="{{ asset('js/eliminar_carrito.js') }}"></script>


{{-- JS Bootstrap v5 --}}
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
@endsection
