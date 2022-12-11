@extends('layouts.app')

@section('titulo', 'Formulario para Modificar estado de pedido')

<link rel="stylesheet" href="{{ asset('css/pedidos.css') }}">

{{-- FontAwesome 6.2.0 --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

@section('content')

<div class="container mt-3 pb-5 pl-4" id="formulario_cliente">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-5">
            <div class="card pr-5 pl-4">
                <div class="card-header border-0 bg-white">
                    <h2 class="text-left text-dark mt-4">{{ __('Modificar estado de Pedido') }}</h2>
                </div>

                <div class="container mt-5 mb-2">
                    <form action="{{ route('mozo.update', $pedido->id) }}" method="POST">
                        @csrf
                        
                        <div class="form-group row pr-4 pl-4">
                            {{-- Estado de pedido --}}
                            <div class="input-group mb-4">
                                <span class="input-group-text bg-secondary" id="basic-addon1">
                                    <span class="fas fa-solid fa-list text-white"></span>
                                </span>

                                <select class="form-control @error('estado') is-invalid @enderror" name="estado" value="{{ old('estado') }}"
                                    id="estado" required autocomplete="estado">
                                    <option value="">Seleccione estado de pedido</option>
                                    
                                    @foreach ($getPedidos as $pedido)
                                        @foreach ($auxEstado as $estado)
                                            <option value="{{ $estado }}">{{ $estado }}</option>
                                        @endforeach
                                    @endforeach
                                </select>

                                @error('estado')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="container-fluid text-dark">
                            <span>
                                <strong>Estado actual del pedido:</strong>
                                <span>{{ $estadoActual }}</span>
                            </span>
                        </div>

                        <div class="form-group mt-xs-3 mt-lg-4 mt-md-4 row">
                            <div class="pt-4 ml-4">
                                <a href="{{ route('mozo.pedidos') }}" class="btn btn-danger">
                                    <span class="fas fa-solid fa-arrow-left"></span>
                                    {{ __('Cancelar') }}
                                </a>

                                <button type="submit" class="btn btn-info text-white ml-4">
                                    <span class="fas fa-solid fa-user-edit"></span>
                                    {{ __('Editar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection