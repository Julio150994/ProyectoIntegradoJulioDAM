@extends('layouts.app')

<title>Formulario para editar empresa de reparto</title>
<link rel="stylesheet" href="{{ asset('css/empresas_reparto.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

@section('content')
<div class="container mt-3 pb-5 pl-4" id="formulario_empresa">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-5">
            <div class="card pr-5 pl-4">
                <div class="card-header border-0 bg-white">
                    <h2 class="text-left text-dark mt-4">{{ __('Editar empresa de reparto') }}</h2>
                </div>

                <div class="container mt-5 mb-5">
                    <form action="{{ route('empresas_reparto.update', $empresa_reparto->id ) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row pr-4 pl-4">
                            {{-- Nombre de la empresa --}}
                            <div class="input-group mb-4">
                                <span class="input-group-text bg-secondary" id="basic-addon1">
                                    <span class="fas fa-sharp fa-solid fa-building text-white"></span>
                                </span>
                                <input type="text" placeholder="Nombre de la Empresa" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ $empresa_reparto->nombre }}" id="nombre" required autocomplete="nombre">

                                @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row pr-4 pl-4">
                            {{-- Dirección --}}
                            <div class="input-group mb-4">
                                <span class="input-group-text bg-secondary" id="basic-addon1">
                                    <span class="fas fa-solid fa-location-dot text-white"></span>
                                </span>
                                <input type="text" placeholder="Dirección" class="form-control @error('direccion') is-invalid @enderror" name="direccion" value="{{ $empresa_reparto->direccion }}" id="direccion" required autocomplete="direccion">

                                @error('direccion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row pr-4 pl-4">
                            {{-- Email --}}
                            <div class="input-group mb-4">
                                <span class="input-group-text bg-secondary" id="basic-addon1">
                                    <span class="fas fa-solid fa-envelope text-white"></span>
                                </span>
                                <input type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $empresa_reparto->email }}" id="email" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row pr-4 pl-4">
                            {{-- Teléfono --}}
                            <div class="input-group mb-4">
                                <span class="input-group-text bg-secondary" id="basic-addon1">
                                    <span class="fas fa-solid fa-phone text-white"></span>
                                </span>
                                <input type="text" placeholder="Teléfono" class="form-control @error('telefono') is-invalid @enderror" name="telefono" value="{{ $empresa_reparto->telefono }}" id="telefono" required autocomplete="telefono">

                                @error('telefono')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row pt-3 pr-4 pl-4">
                            {{-- Imágen --}}
                            
                            <div class="input-group mb-4">
                                <span class="input-group-text bg-secondary" id="basic-addon1">
                                    <span class="fas fa-solid fa-images text-white"></span>
                                </span>
                                {{-- Editamos una sola imágen --}}
                                <input type="file" name="imagen" class="form-control @error('imagen') is-invalid @enderror"
                                    id="imagen" value="{{ $empresa_reparto->imagen }}" required autocomplete="imagen" required/>

                                @error('imagen')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <label for="imagen" class="text-left text-dark">
                                <strong>Imágen actual:</strong>
                                <span>{{ $imagenActual }}</span>
                            </label>
                        </div>

                        <div class="form-group row pr-4 pl-4">
                            {{-- Coste Pedido Normal --}}
                            <div class="input-group mb-4">
                                <span class="input-group-text bg-secondary" id="basic-addon1">
                                    <span class="fas fa-solid fa-euro-sign text-white"></span>
                                </span>
                                <input type="number" step="0.01" placeholder="Coste Pedido Normal" class="form-control @error('coste_pedido_normal') is-invalid @enderror" name="coste_pedido_normal" value="{{ $empresa_reparto->coste_pedido_normal }}"
                                    id="coste_pedido_normal" required autocomplete="coste_pedido_normal">

                                @error('coste_pedido_normal')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row pr-4 pl-4">
                            {{-- Coste Pedido Urgente --}}
                            <div class="input-group mb-4">
                                <span class="input-group-text bg-secondary" id="basic-addon1">
                                    <span class="fas fa-solid fa-euro-sign text-white"></span>
                                </span>
                                <input type="number" step="0.01" placeholder="Coste Pedido Urgente" class="form-control @error('coste_pedido_urgente') is-invalid @enderror" name="coste_pedido_urgente" value="{{ $empresa_reparto->coste_pedido_urgente }}"
                                    id="coste_pedido_urgente" required autocomplete="coste_pedido_urgente">

                                @error('coste_pedido_urgente')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="pt-4 ml-4">
                                <a href="{{ url('/admin/empresas-reparto') }}" class="btn btn-danger">
                                    <span class="fas fa-solid fa-arrow-left"></span>
                                    {{ __('Cancelar') }}
                                </a>

                                <button type="submit" class="btn btn-primary ml-4">
                                    <span class="fas fa-solid fa-pencil"></span>
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
