@extends('layouts.app')

<title>Editar perfil de cliente</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

@section('content')
<div class="container mt-3 pb-5 pl-4" id="formulario_cliente">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-5">
            <div class="card pr-5 pl-4">
                <div class="card-header border-0 bg-white">
                    <h2 class="text-left text-dark mt-4">{{ __('Perfil de cliente') }}</h2>
                </div>

                <div class="container mt-5 mb-5">
                    <form action="{{ route('perfil.update', $id) }}" method="POST">
                        @csrf
                        
                        <div class="form-group row pr-4 pl-4">
                            {{-- Nombre del cliente --}}
                            <div class="input-group mb-4">
                                <span class="input-group-text bg-secondary" id="basic-addon1">
                                    <span class="fas fa-solid fa-user text-white"></span>
                                </span>
                                <input type="text" placeholder="Nombre" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ $nombre }}" id="nombre" required autocomplete="nombre">

                                @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row pt-3 pr-4 pl-4">
                            {{-- Apellidos --}}

                            <div class="input-group mb-4">
                                <span class="input-group-text bg-secondary" id="basic-addon1">
                                    <span class="fas fa-solid fa-user text-white"></span>
                                </span>
                                <input type="text" placeholder="Apellidos" class="form-control @error('apellidos') is-invalid @enderror" name="apellidos" value="{{ $apellidos }}" id="apellidos" required autocomplete="apellidos">

                                @error('apellidos')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row pt-3 pr-4 pl-4">
                            {{-- Email --}}

                            <div class="input-group mb-4">
                                <span class="input-group-text bg-secondary" id="basic-addon1">
                                    <span class="fas fa-solid fa-envelope text-white"></span>
                                </span>
                                <input type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email }}" id="email" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row pt-3 pr-4 pl-4">
                            {{-- Username --}}

                            <div class="input-group mb-4">
                                <span class="input-group-text bg-secondary" id="basic-addon1">
                                    <span class="fas fa-solid fa-circle-user text-white"></span>
                                </span>
                                <input type="text" placeholder="Username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ $username }}" id="username" required autocomplete="username" autofocus>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row pt-3 pr-4 pl-4">
                            {{-- Password --}}

                            <div class="input-group mb-4">
                                <span class="input-group-text bg-secondary" id="basic-addon1">
                                    <span class="fas fa-solid fa-lock text-white"></span>
                                </span>
                                <input type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" id="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="pt-4 ml-4">
                                <a href="{{ route('menu_tienda') }}" class="btn btn-danger">
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
