@extends('layouts.app')

<title>Formulario para añadir juegos</title>
<link rel="stylesheet" href="{{ asset('css/juego.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

@section('content')
<div class="container mt-3 pb-5 pl-4" id="formulario_juego">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-5">
            <div class="card pr-5 pl-4">
                <div class="card-header border-0 bg-white">
                    <h2 class="text-left text-dark mt-4">{{ __('Nuevo juego de mesa') }}</h2>
                </div>

                <div class="container mt-5 mb-5">
                    <form action="{{ route('juegos.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row pr-4 pl-4">
                            {{-- Nombre del juego --}}
                            <div class="input-group mb-4">
                                <span class="input-group-text bg-secondary" id="basic-addon1">
                                    <span class="fas fa-regular fa-chess-board text-white"></span>
                                </span>
                                <input type="text" placeholder="Nombre" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre') }}" id="nombre" required autocomplete="nombre">

                                @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row pt-3 pr-4 pl-4">
                            {{-- Descripción --}}

                            <div class="input-group mb-4">
                                <span class="input-group-text bg-secondary" id="basic-addon1">
                                    <span class="fas fa-solid fa-align-justify text-white"></span>
                                </span>
                                <textarea class="form-control @error('descripcion') is-invalid @enderror" placeholder="Descripción" name="descripcion" value="{{ old('descripcion') }}" id="descripcion" required autocomplete="descripcion"></textarea>

                                @error('descripcion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row pt-3 pr-4 pl-4">
                            {{-- Precio --}}

                            <div class="input-group mb-4">
                                <span class="input-group-text bg-secondary" id="basic-addon1">
                                    <span class="fas fa-solid fa-euro-sign text-white"></span>
                                </span>
                                <input type="number" step=".01" placeholder="Precio" class="form-control @error('precio') is-invalid @enderror" name="precio" value="{{ old('precio') }}" id="precio" required autocomplete="precio">

                                @error('precio')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row pt-3 pr-4 pl-4">
                            {{-- Imágenes a subir --}}

                            <div class="input-group mb-4">
                                <span class="input-group-text bg-secondary" id="basic-addon1">
                                    <span class="fas fa-solid fa-images text-white"></span>
                                </span>
                                {{-- Añadimos múltiples imágenes y las subimos a la base de datos --}}
                                <div>
                                    <input type="file" name="url[]" class="btn btn-light btn-block @error('url') is-invalid @enderror"
                                        multiple="multiple" name="url" value="{{ old('url') }}" id="url" required autocomplete="url" required/>
                                </div>

                                @error('url')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="pt-4 ml-4">
                                <a href="{{ url('/admin/catalogo') }}" class="btn btn-danger">
                                    <span class="fas fa-solid fa-arrow-left"></span>
                                    {{ __('Cancelar') }}
                                </a>

                                <button type="submit" class="btn btn-success ml-4">
                                    <span class="fas fa-solid fa-circle-plus"></span>
                                    {{ __('Añadir') }}
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