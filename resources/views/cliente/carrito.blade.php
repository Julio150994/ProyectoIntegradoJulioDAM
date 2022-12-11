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

    <div class="row row-cols-lg-3 p-5 mb-5">
        <div class="mb-5 mr-5 centrado_carrito">
            <div class="col-9 m-1 juego_mesa rounded ml-5">
                @foreach ($imagenes as $imagen)
                    <div class="align-content-center">
                        @if ($juegoMesa->id == $imagen->juego_id)
                            <div class="bg-light rounded altura_imagen">
                                <img class="img-fluid w-auto justify-content-center ml-xs-1 ml-lg-3 ml-md-3 medidas_imagen" loading="lazy" src="{{ asset($imagen->url) }}"
                                    draggable="false" decoding="async" alt="Juego de Landgame" data-text="Error al mostrar esta imagen."
                                    data-text-short="No se pudo cargar la imagen"/>
                            </div>
                        @endif
                    </div>
                @endforeach

                <a href="{{ route('menu_tienda') }}" class="btn btn-md border border-0 mt-5" id="btnMenu">
                    <span class="fas fa-solid fa-arrow-left"></span>
                    <span>Volver al menú</span>
                </a>
            </div>
        </div>

        <div class="mr-5 mb-5">
            <h3 class="text-white">{{ $juegoMesa->nombre }}</h3>

            <div class="mt-3">
                <strong>Descripción</strong>
                <p>{{ $juegoMesa->descripcion }}</p>
            </div>

            <div class="mt-4">
                <strong>Stock</strong>

                @if($juegoMesa->stock == 1)
                    <span class="bg-success text-white ml-4 pl-2 pr-2 rounded">
                        En Stock
                    </span>
                @else
                    <span class="ml-4 pl-2 pr-2 rounded btnStock">
                        No en Stock
                    </span>
                @endif
            </div>

            <div class="rounded border border-dark juego_mesa fondo_carrito h-50 mt-5">
                <form class="mensajeModal m-3" action="{{ route('cliente.aniadirCarrito', $juegoMesa->id) }}" method="POST">
                    @csrf
    
                    <h4 class="text-left text-white" name="precioUnitario" value="{{ old($juegoMesa->precio,2) }}" id="precioUnitario">
                        {{ number_format($juegoMesa->precio,2) }} €
                    </h4>
    
                    <div class="text-center rounded container_carrito">
                        <div class="row m-4 align-items-center pt-5">
                            <div class="col-auto ml-2">
                                <label for="cantidad" class="col-form-label">
                                    <span class="text-white">Cantidad:</span>
                                </label>
                            </div>
                            <div class="col-auto">
                                <input type="number" class="form-control @error('cantidad') is-invalid @enderror" name="cantidad"
                                    value="{{ old('cantidad') }}" placeholder="1" id="cantidad"
                                    required autocomplete="cantidad"/>
    
                                @error('cantidad')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <div class="col-auto">
                                <input type="button" class="btn btn-md text-white" id="btnRestar" value="-"
                                    onclick="restarCantidad('{{ number_format($juegoMesa->precio,2) }}')"/>
                            </div>
    
                            <div class="col-auto">
                                <input type="button" class="btn btn-md btn-primary text-white" id="btnSumar" value="+"
                                    onclick="sumarCantidad('{{ number_format($juegoMesa->precio,2) }}')"/>
                            </div>
    
                            {{-- Comprobación de envio de precio correcta antes de ocultar --}}
                            <div class="col-auto mt-3">
                                <input type="hidden" step="0.01" class="form-control @error('precioUnitario') is-invalid @enderror" name="precioUnitario"
                                    value="{{ number_format($juegoMesa->precio,2) }}" id="precioUnitario" required autocomplete="precioUnitario">
    
                                @error('precioUnitario')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
    
                        <div class="container-fluid mt-5">
                            <div class="ml-4 mr-5">
                                <button type="submit" class="btn btn-block text-white" data-bs-toggle="modal"
                                    data-bs-target="#carrito" id="btnCarrito">
                                    <span class="fas fa-solid fa-cart-shopping"></span>
                                    <span>Añadir al carrito</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            {{-- Enlace para el pay pal --}}
            <div class="mt-xs-2 mt-lg-5 mt-md-5">
                <a href="{{ route('cliente.compra') }}" class="btn btn-warning text-white border border-0" id="btnMenu">
                    <span class="fas fa-solid fa-eye"></span>
                    <span>Ver carrito</span>
                </a>
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