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
    <a class="btn btn-dark text-white text-decoration-none" href="{{ route('cliente.compra') }}"
        id="link_paypal">
        <span class="fas fa-solid fa-arrow-left"></span>
        <span>Volver al carrito</span>
    </a>

    <div class="ml-xs-2 ml-lg-3 ml-md-3">
        <div class="m-xs-3 m-lg-4 m-md-4">
            <h2 class="font-bold text-white pt-xs-2 pt-lg-4 pt-md-4 pl-xs-2 pl-lg-4 pl-md-4">
                Pedido generado para {{ $clienteActual }}
            </h2>
    
            <h2 class="font-bold text-white mt-xs-2 mt-lg-5 mt-md-5 pl-xs-2 pl-lg-4 pl-md-4"
                id="precioTotalCompra"><span>Importe total:</span> {{ $precioTotalCompra }} €</h2>
        </div>
    </div>

    {{-- Mensaje después de finalizar la compra después de realizar el pago con PayPal--}}
    @if(session('paymentStatus'))
        <div class="alert alert-{{ session('paymentStatus')[0] }} text-center m-xs-3 m-lg-4 m-mt-4">
            {{ session('paymentStatus')[1] }}
        </div>
    @endif

    @if($pedidosCliente->count() == 0)
        {{-- Botón para realizar el pago con PayPal de este nuevo pedido --}}
        <form class="ml-xs-2 ml-lg-5 ml-md-5 mt-xs-3 mt-lg-5 mt-md-5"
            action="{{ route('cliente.pago') }}" method="POST" target="_top">
            @csrf

            <input type="hidden" name="cmd" value="_s-xclick">
            <input type="hidden" name="hosted_button_id" value="WEHG2WTKY3E6S">
            <input type="image" src="https://www.paypalobjects.com/es_ES/ES/i/btn/btn_paynowCC_LG.gif" border="0"
                name="submit" alt="PayPal, la forma rápida y segura de pagar en Internet.">
            <img alt="" border="0" src="https://www.paypalobjects.com/es_ES/i/scr/pixel.gif" width="1" height="1">
        </form>

        <div class="alert alert-warning text-center p-xs-2 p-lg-4 p-md-4">
            <span>{{ $clienteActual }} no tiene pedidos comprados. Para ello pague por PayPal.</span>
        </div>
    @else
    <div class="container-fluid">
        @if($empresasReparto->count() > 0)
        {{-- Datos a introducir del envio --}}
        <form action="{{ route('cliente.direccionEnvio') }}" method="POST">
            @csrf

            <div class="bg-formulario rounded m-5">
                <div class="row p-5">
                    <div class="col-xs-2 col-lg-3 col-md-3">
                        <h3 class="text-center text-secondary mt-xs-3 mt-lg-4 mt-md-4 mb-xs-3
                            mb-lg-5 mb-md-5 mr-xs-4 mr-lg-4 mr-md-4">
                            Datos de envio
                        </h3>
            
                        <div class="pl-xs-2 pl-lg-3 pl-md-3 mr-lg-3 mr-md-3">
                            <div class="input-group mb-xs-2 mb-lg-4 mb-md-4">
                                {{-- Dirección --}}
                                <span class="input-group-text" id="basic-addon1">
                                    <span class="fas fa-solid fa-house-user"></span>
                                </span>
                                <input type="text" placeholder="Dirección" class="form-control @error('direccion') is-invalid @enderror"
                                    name="direccion" value="{{ old('direccion') }}" id="direccion"
                                    required autocomplete="direccion">
                            
                                @error('direccion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                
                            <div class="input-group mb-xs-2 mb-lg-4 mb-md-4">
                                {{-- Nombre de calle --}}
                                <span class="input-group-text" id="basic-addon1">
                                    <span class="fas fa-solid fa-road"></span>
                                </span>
                                <input type="text" placeholder="Nombre de calle" class="form-control @error('nombreCalle') is-invalid @enderror"
                                    name="nombreCalle" value="{{ old('nombreCalle') }}" id="nombreCalle"
                                    required autocomplete="nombreCalle">
                            
                                @error('nombreCalle')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                
                            <div class="input-group mb-xs-2 mb-lg-4 mb-md-4">
                                {{-- Portal --}}
                                <span class="input-group-text" id="basic-addon1">
                                    <span class="fas fa-solid fa-home"></span>
                                </span>
                                <input type="number" placeholder="Portal" class="form-control @error('portal') is-invalid @enderror"
                                    name="portal" value="{{ old('portal') }}" id="portal" required autocomplete="portal">
                            
                                @error('portal')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                
                            <div class="input-group mb-xs-2 mb-lg-4 mb-md-4">
                                {{-- Piso (es el único atributo opcional) --}}
                                <span class="input-group-text" id="basic-addon1">
                                    <span class="fas fa-solid fa-building-user"></span>
                                </span>
                                <input type="text" placeholder="Piso" class="form-control @error('piso') is-invalid @enderror"
                                    name="piso" value="{{ old('piso') }}" id="piso" autocomplete="piso">
                            
                                @error('piso')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                
                            <div class="input-group mb-xs-2 mb-lg-4 mb-md-4">
                                {{-- Código postal --}}
                                <span class="input-group-text" id="basic-addon1">
                                    <span class="fas fa-solid fa-envelope"></span>
                                </span>
                                <input type="number" placeholder="Código postal" class="form-control @error('codigoPostal') is-invalid @enderror"
                                    name="codigoPostal" value="{{ old('codigoPostal') }}" id="codigoPostal"
                                    required autocomplete="codigoPostal">
                            
                                @error('codigoPostal')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                
                            <div class="input-group mb-xs-2 mb-lg-4 mb-md-4">
                                {{-- Ciudad --}}
                                <span class="input-group-text" id="basic-addon1">
                                    <span class="fas fa-solid fa-city"></span>
                                </span>
                                <input type="text" placeholder="Ciudad" class="form-control @error('ciudad') is-invalid @enderror"
                                    name="ciudad" value="{{ old('ciudad') }}" id="ciudad"
                                    required autocomplete="ciudad">
                            
                                @error('ciudad')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                
                            <div class="input-group mb-xs-2 mb-lg-4 mb-md-4">
                                {{-- Provincia --}}
                                <span class="input-group-text" id="basic-addon1">
                                    <span class="fas fa-solid fa-map-location"></span>
                                </span>
                                <input type="text" placeholder="Provincia" class="form-control @error('provincia') is-invalid @enderror"
                                    name="provincia" value="{{ old('provincia') }}" id="provincia"
                                    required autocomplete="provincia">
                            
                                @error('provincia')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                
                            <div class="input-group mb-xs-2 mb-lg-4 mb-md-4">
                                {{-- País --}}
                                <span class="input-group-text" id="basic-addon1">
                                    <span class="fas fa-solid fa-globe"></span>
                                </span>
                                <input type="text" placeholder="País" class="form-control @error('pais') is-invalid @enderror"
                                    name="pais" value="{{ old('pais') }}" id="pais"
                                    required autocomplete="pais">
                            
                                @error('pais')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                
                            <div class="input-group mb-xs-2 mb-lg-4 mb-md-4">
                                {{-- Teléfono --}}
                                <span class="input-group-text" id="basic-addon1">
                                    <span class="fas fa-solid fa-phone"></span>
                                </span>
                                <input type="text" placeholder="Nº de teléfono" class="form-control @error('telefono') is-invalid @enderror"
                                    name="telefono" value="{{ old('telefono') }}" id="telefono"
                                    required autocomplete="telefono">
                            
                                @error('telefono')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            {{-- <label for="observaciones" class="text-dark">Observaciones</label> --}}
                            <div class="input-group mb-xs-1 mb-lg-3 mb-md-3">
                                {{-- Observaciones --}}
                                <span class="input-group-text" id="basic-addon1">
                                    <span class="fas fa-solid fa-list"></span>
                                </span>

                                <input type="text" placeholder="Observaciones" class="form-control @error('observaciones') is-invalid @enderror"
                                    name="observaciones" value="{{ old('observaciones') }}" id="observaciones"
                                    required autocomplete="observaciones">

                                {{-- <textarea class="form-control @error('observaciones') is-invalid @enderror"
                                    rows="3" name="observaciones" value="{{ old('observaciones') }}"
                                    id="observaciones" placeholder="Observaciones" required autocomplete="observaciones">
                                </textarea> --}}
        
                                @error('observaciones')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
    
                    <div class="container-fluid w-75 col-xs-2 col-lg-3 col-md-3">
                        {{-- Para seleccionar un tipo de coste u otro de nuestras empresas de reparto --}}
                        <div class="row mb-xs-2 mb-lg-5 mb-md-5">
                          <div class="col-lg-6">
                            <h3 class="text-center text-secondary mb-xs-2 mb-lg-5 mb-md-5 pt-lg-4 pt-md-4">
                                Seleccione coste normal
                            </h3>
        
                            <div class="text-dark m-xs-2 m-lg-4 m-md-4">
                                @foreach ($empresasReparto as $empresa)
                                <div class="row bg-white rounded p-lg-2 p-md-2 mb-xs-2 mb-lg-4 mb-md-4">
                                    <div class="col-xs-1 col-lg-1 col-md-1">
                                        <input class="form-check-input mt-xs-2 mt-lg-4 mt-md-4 ml-xs-2 ml-lg-2 ml-md-2 @error('empresa_reparto_id') is-invalid @enderror" type="radio"
                                            name="empresa_reparto_id" value="{{ $empresa->id }}" id="empresa_reparto_id" required autocomplete="empresa_reparto_id"
                                            onclick="costePedidoNormal({{ $precioTotalCompra }}, {{ $empresa->coste_pedido_normal }})">
                                    </div>
                    
                                    <div class="col-xs-1 col-lg-3 col-md-3 mt-xs-1 mt-lg-2 mt-md-2">
                                        <img src="{{ asset($empresa->imagen) }}" class="w-100" alt="Empresa de reparto"/>
                                    </div>
                    
                                    <div class="col-xs-2 col-lg-4 col-md-4 text-center">
                                        <label class="form-check-label mt-xs-2 mt-lg-4 mt-md-4"
                                            for="empresa_reparto_id">
                                            {{ $empresa->nombre }}
                                        </label>
                                    </div>
                    
                                    <div class="col-xs-2 col-lg-4 col-md-4">
                                        <div class="pl-xs-2 pl-lg-4 pl-md-4 pr-xs-2 pr-lg-4 pr-md-4 mt-xs-2 mt-lg-4 mt-md-4">
                                            Entre 4 y 7 días laborales
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
        
                            @error('empresa_reparto_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
        
                          <div class="col-lg-6">
                            <h3 class="text-center text-secondary mb-xs-2 mb-lg-5 mb-md-5 pt-lg-4 pt-md-4">
                                Seleccione coste urgente
                            </h3>
        
                            <div class="text-dark m-xs-2 m-lg-4 m-md-4">
                                @foreach ($empresasReparto as $empresa)
                                <div class="row bg-white rounded p-lg-2 p-md-2 mb-xs-2 mb-lg-4 mb-md-4">
                                    <div class="col-xs-1 col-lg-1 col-md-1">
                                        <input class="form-check-input mt-xs-2 mt-lg-4 mt-md-4 ml-xs-2 ml-lg-2 ml-md-2 @error('empresa_reparto_id') is-invalid @enderror" type="radio"
                                            name="empresa_reparto_id" value="{{ $empresa->id }}" id="empresa_reparto_id" required autocomplete="empresa_reparto_id"
                                            onclick="costePedidoUrgente({{ $precioTotalCompra }}, {{ $empresa->coste_pedido_urgente }})">
                                    </div>
                    
                                    <div class="col-xs-1 col-lg-3 col-md-3 mt-xs-1 mt-lg-2 mt-md-2">
                                        <img src="{{ asset($empresa->imagen) }}" class="w-100" alt="Empresa de reparto"/>
                                    </div>
                    
                                    <div class="col-xs-2 col-lg-4 col-md-4 text-center">
                                        <label class="form-check-label mt-xs-2 mt-lg-4 mt-md-4"
                                            for="empresa_reparto_id">
                                            {{ $empresa->nombre }}
                                        </label>
                                    </div>
                    
                                    <div class="col-xs-2 col-lg-4 col-md-4">
                                        <div class="pl-xs-2 pl-lg-4 pl-md-4 pr-xs-2 pr-lg-4 pr-md-4 mt-xs-2 mt-lg-4 mt-md-4">
                                            Entre 1 y 2 días laborales
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            </div>
        
                            @error('empresa_reparto_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                      </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <div class="col-xs-4 col-lg-3 col-md-3 ml-xs-2 ml-lg-3 ml-md-3">
                    <button class="btn btn-warning text-white border border-0 mb-xs-2 mb-lg-5 mb-md-5" type="submit">
                        <span class="fas fa-solid fa-cart-shopping"></span>
                        <span>Finalizar compra</span>
                    </button>
    
                    @if($direccionEnvioCliente > 0)
                        <a href="{{ route('cliente.factura_pdf') }}" class="btn btn-success
                            text-white border border-0 mb-xs-2 mb-lg-5 mb-md-5 ml-xs-2 ml-lg-3 ml-md-3">
                            <span class="fas fa-solid fa-file-pdf"></span>
                            <span>Generar Factura</span>
                        </a>
                    @endif
                </div>
            </div>
        </form>
        @else
            <div class="alert alert-warning text-center p-xs-2 p-lg-4 p-md-4">
                <span>No se han encontrado empresas de reparto</span>
            </div>
        @endif
    </div>
    @endif
</div>

{{-- Reutilizamos el componente footer --}}
<x-footer/>

{{-- JS para aumentar el coste, según el tipo de pedido --}}
<script type="text/javascript" src="{{ asset('js/coste_pedido.js') }}"></script>

{{-- JS Bootstrap v5 --}}
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>

@endsection