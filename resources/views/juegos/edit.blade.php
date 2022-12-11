@extends('layouts.app')

<title>Formulario para editar juegos</title>
<link rel="stylesheet" href="{{ asset('css/juego.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

@section('content')
<div class="container mt-3 pb-5 pl-4" id="formulario_juego">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-8 mt-xs-3 mt-lg-5 mt-md-5">
            <div class="card pr-5 pl-4">
                <div class="card-header border-0 bg-white">
                    <h2 class="text-left text-dark mt-4">{{ __('Editar Juego de mesa') }}</h2>
                </div>

                <div class="container mt-5 mb-5">
                    <form action="{{ route('juegos.update', $juegoMesa->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="form-group row pr-xs-2 pr-lg-4 pl-md-4">
                            {{-- Nombre del juego --}}
                            <div class="input-group mb-4">
                                <span class="input-group-text bg-secondary" id="basic-addon1">
                                    <span class="fas fa-regular fa-chess-board text-white"></span>
                                </span>
                                <input type="text" placeholder="Nombre" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ $juegoMesa->nombre }}" id="nombre" required autocomplete="nombre">

                                @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row pt-xs-2 pt-lg-3 pt-md-3 pr-xs-2 pr-lg-4 pl-md-4">
                            {{-- Descripción --}}

                            <div class="input-group mb-4">
                                <span class="input-group-text bg-secondary" id="basic-addon1">
                                    <span class="fas fa-solid fa-align-justify text-white"></span>
                                </span>

                                <input type="text" placeholder="Descripción" class="form-control @error('descripcion') is-invalid @enderror" placeholder="Descripción" name="descripcion" value="{{ $juegoMesa->descripcion }}" id="descripcion" required autocomplete="descripcion">

                                @error('descripcion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row pt-xs-2 pt-lg-3 pt-md-3 pr-xs-2 pr-lg-4 pl-md-4">
                            {{-- Precio --}}

                            <div class="input-group mb-4">
                                <span class="input-group-text bg-secondary" id="basic-addon1">
                                    <span class="fas fa-solid fa-euro-sign text-white"></span>
                                </span>
                                <input type="number" step=".01" placeholder="Precio" class="form-control @error('precio') is-invalid @enderror" name="precio"
                                    value="{{ $juegoMesa->precio }}" id="precio" required autocomplete="precio">

                                @error('precio')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row pt-xs-2 pt-lg-3 pt-md-3 pr-xs-2 pr-lg-4 pl-md-4">
                            {{-- Imágenes a subir --}}

                            <div class="input-group mb-4">
                                <span class="input-group-text bg-secondary" id="basic-addon1">
                                    <span class="fas fa-solid fa-images text-white"></span>
                                </span>
                                {{-- Editamos múltiples imágenes y las subimos a la base de datos --}}

                                <div>
                                    @foreach ($imagenesJuego as $imagen)
                                    <input type="file" name="url[]" class="btn btn-light btn-block @error('url') is-invalid @enderror"
                                        id="url" multiple="multiple" name="url" value="{{ $imagen->url }}" id="url" required autocomplete="url" required/>
                                        @break
                                    @endforeach
                                </div>

                                {{-- Aquí estaba lo de eliminar imágenes pudiendo seleccionar una --}}

                                @error('url')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <strong class="text-dark">Imágenes actuales:</strong>
                        
                        <div class="form-group row pt-xs-2 pt-lg-3 pt-md-3 pr-xs-2 pr-lg-4 pl-md-4">
                            <!-- Para mostrar las imágenes actuales del juego a editar -->                            
                            <ol class="text-dark">
                                @foreach ($imagenesJuego as $imagen)
                                    <li class="border-0">{{ $imagen->url }}</li>
                                @endforeach
                            </ol>
                        </div>


                        <div class="form-group row mt-5">
                            <div class="ml-4">
                                <a href="{{ url('/admin/catalogo') }}" class="btn btn-danger">
                                    <span class="fas fa-solid fa-arrow-left"></span>
                                    {{ __('Cancelar') }}
                                </a>

                                <button type="submit" class="btn btn-info text-white ml-4">
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

{{-- Mensaje de confirmación de JS con SweetAlert 2 antes de eliminar cliente --}}
<link rel="stylesheet" href="sweetalert2.min.css">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="sweetalert2.min.js"></script>
<script type="text/javascript" src="{{ asset('js/eliminar_imagen_juego.js') }}"></script>
@endsection
