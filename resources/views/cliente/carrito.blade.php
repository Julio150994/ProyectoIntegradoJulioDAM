@extends('layouts.app')

@section('titulo', 'Carrito de la compra')

<link rel="stylesheet" href="{{ asset('css/ver_juegos_mesa.css') }}">

{{-- CSS Bootstrap 5 --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

{{-- FontAwesome 6.2.0 --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

@section('content')
{{-- Reutilizamos nuestro header como componente --}}
<x-header/>


<div class="container-fluid mt-5">
    {{-- Mensaje en modal para ver los datos actuales de compra en sesión al pulsar "Añadir al carrito" --}}
    @if(session('sesion_carrito'))
        <div class="container-fluid col-xs-12 col-lg-8 col-md-8">
            <div class="alert alert-success">
                <h3 class="text-left">Juego añadido correctamente al carrito</h3>

                <p><strong>Cantidad: </strong> {{ session('sesion_carrito')[0] }}</p>
                <p><strong>Precio total: </strong> {{ session('sesion_carrito')[1] }} €</p>
            </div>
        </div>
    @endif

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-xs-2 col-lg-3 col-md-3">
                @foreach ($imagenes as $imagen)
                    @if ($juegoMesa->id == $imagen->juego_id)
                        <div class="rounded altura_imagen">
                            <img class="img-fluid h-75 w-100 justify-content-left" loading="lazy" src="{{ asset($imagen->url) }}"
                                draggable="false" decoding="async" alt="Juego de Landgame" data-text="Error al mostrar esta imagen."
                                data-text-short="No se pudo cargar la imagen"/>
                        </div>
                    @endif
                @endforeach
            </div>

            <div class="col-xs-4 col-lg-6 col-md-6 mb-xs-3 mb-lg-4 mb-md-4">
                <div class="ml-xs-3 ml-lg-5 ml-md-5">
                    <h3>{{ $juegoMesa->nombre }}</h3>
                </div>
                <div class="mt-xs-3 mt-lg-3 mt-md-3">
                    <span class="ml-xs-2 ml-lg-5 ml-md-5">{{ $juegoMesa->descripcion }}</span>
                </div>

                <div class="mt-xs-2 mt-lg-4 mt-md-4"></div>

                <div class="mt-xs-3 mt-lg-5 mt-md-5 ml-xs-3 ml-lg-5 ml-md-5">
                    <div class="rounded border border-dark fondo_carrito mt-xs-3 mt-lg-5 mt-md-5 p-xs-3 p-lg-5 p-md-5">
                        <form action="{{ route('cliente.aniadirCarrito', $juegoMesa->id) }}" method="POST">
                            @csrf

                            <div class="row align-items-center">
                                <div class="col-xs-3 col-lg-4 col-md-4">
                                    <h4 class="text-left text-white" name="precioUnitario" value="{{ old($juegoMesa->precio,2) }}" id="precioUnitario">
                                        {{ number_format($juegoMesa->precio,2) }} €/ud.
                                    </h4>
                                </div>

                                <div class="col">
                                    <input type="button" class="btn btn-md text-white rounded-circle" id="btnRestar" value="-"
                                        onclick="restarCantidad('{{ number_format($juegoMesa->precio,2) }}')"/>
                                </div>

                                <div class="col">
                                    <input class="form-control @error('cantidad') is-invalid @enderror" name="cantidad"
                                        value="{{ old('cantidad') }}" placeholder="1" id="cantidad"
                                        required autocomplete="cantidad"/>

                                    @error('cantidad')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col">
                                    <input type="button" class="btn btn-md btn-primary text-white rounded-circle" id="btnSumar" value="+"
                                        onclick="sumarCantidad('{{ number_format($juegoMesa->precio,2) }}')"/>
                                </div>

                                <div class="col">
                                    <input type="hidden" step="0.01" class="form-control @error('precioUnitario') is-invalid @enderror" name="precioUnitario"
                                        value="{{ number_format($juegoMesa->precio,2) }}" id="precioUnitario" required autocomplete="precioUnitario">

                                    @error('precioUnitario')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-xs-2 col-lg-4 col-md-4">
                                    <button type="submit" class="btn btn-md text-white" data-bs-toggle="modal"
                                        data-bs-target="#carrito" id="btnCarrito">
                                        <span class="fas fa-solid fa-cart-shopping"></span>
                                        <span>Añadir al carrito</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="mt-xs-2 mt-lg-5 mt-md-5">
                    <div class="row">
                        <div class="col-4 ml-5">
                            <a href="{{ route('menu_tienda') }}" class="btn btn-md border border-0 mt-5" id="btnMenu">
                                <span class="fas fa-solid fa-arrow-left"></span>
                                <span>Volver al menú</span>
                            </a>
                        </div>

                        <div class="col-2">
                            <a href="{{ route('cliente.juegosCarrito') }}" class="btn btn-warning text-white border border-0" id="btnMenu">
                                <span class="fas fa-solid fa-eye"></span>
                                <span>Ver carrito</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mr-xs-3 mr-lg-5 mr-md-5">
            <div class="container-xl border-dark fondo_carrito p-xs-2 p-lg-4 p-md-4 mb-xs-3 mb-lg-5 mb-md-5">
                <div class="row p-xs-2 p-lg-4 p-md-4">
                  <div class="col-sm-5">
                    <span class="fas fa-solid fa-tag"></span>
                    <p>MEJOR PRECIO GARANTIZADO</p>
                    <p>o te abonamos la diferencia <a href="#">+info</a></p>
                  </div>
                  <div class="col-sm-5">
                    <span class="fas fa-solid fa-book-bookmark"></span>
                    <p>ENTREGA 24/48H</p>
                    <p>laborales</p>
                  </div>
                  <div class="col-sm">
                    <span class="fas fa-solid fa-shield"></span>
                    <p>COMPRA</p>
                    <p>100% segura</p>
                  </div>
                </div>
            </div>
        </div>
    </div>


    {{-- Mostramos el "carrito de la compra" borrar posteriormente --}}
    @yield('compra_juegos')
</div>

{{-- Aquí mostramos el footer como otro componente --}}
<x-footer/>

{{-- JS Bootstrap v5 --}}
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>

{{-- JS para los botones aumentar y disminuir --}}
<script type="text/javascript" src="{{ asset('js/ver_juego.js') }}"></script>

@endsection
