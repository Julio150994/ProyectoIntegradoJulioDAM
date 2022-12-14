@extends('layouts.app')

@section('titulo', 'Pago con PayPal del cliente')

{{-- CSS Bootstrap 5 --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

{{-- FontAwesome 6.2.0 --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

<link rel="stylesheet" href="{{ asset('css/carrito.css') }}">

@section('content')
{{-- Reutilizamos el componente header --}}
<x-header/>

<div class="my-5 mx-5 border-2 rounded-lg container-envios">

    {{-- Mensaje después de realizar las direcciones de envio--}}
    @if(session('paymentStatus'))
        <div class="alert alert-{{ session('paymentStatus')[0] }} text-center m-xs-3 m-lg-4 m-mt-4">
            {{ session('paymentStatus')[1] }}
        </div>
    @endif

     {{-- Botón para realizar el pago con PayPal de este nuevo pedido --}}
     <div class="bg-paypal purple container p-xs-3 p-lg-4 p-md-4 rounded text-center">
        <div class="ml-xs-2 ml-lg-3 ml-md-3">
            <div class="m-xs-3 m-lg-4 m-md-4">
                <h2 class="font-bold text-white mt-xs-2 mt-lg-5 mt-md-5 pl-xs-2 pl-lg-4 pl-md-4"
                    id="precioTotalCompra"><span>Importe total:</span> {{ $precioTotalCompra }} €</h2>
            </div>
        </div>

        <form class="ml-xs-2 ml-lg-5 ml-md-5 mt-xs-3 mt-lg-5 mt-md-5"
            action="{{ route('cliente.pago') }}" method="POST" target="_top">
            @csrf

            <input type="hidden" name="cmd" value="_s-xclick">
            <input type="hidden" name="hosted_button_id" value="WEHG2WTKY3E6S">
            <input type="image" src="https://www.paypalobjects.com/es_ES/ES/i/btn/btn_paynowCC_LG.gif" border="0"
                name="submit" alt="PayPal, la forma rápida y segura de pagar en Internet.">
            <img alt="" border="0" src="https://www.paypalobjects.com/es_ES/i/scr/pixel.gif" width="1" height="1">
        </form>
     </div>
</div>

{{-- Reutilizamos el componente footer --}}
<x-footer/>

{{-- JS para aumentar el coste, según el tipo de pedido --}}
<script type="text/javascript" src="{{ asset('js/coste_pedido.js') }}"></script>

{{-- JS Bootstrap v5 --}}
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>

@endsection
