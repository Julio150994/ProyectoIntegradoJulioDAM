{{-- menu_tienda --}}

@extends('layouts.app')

@section('titulo', 'Login de usuarios')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/login.css') }}">

@section('content')

<div class="main-login container-fluid pt-xs-2 pt-lg-4 pt-md-4 pb-xs-2 pb-lg-4 pb-md-4">
    <div class="container-xl mt-xs-3 mt-lg-4 mt-md-4">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-md-9 mt-xs-3 mt-xs-2 mt-lg-3 mt-md-3">
                {{-- Mensaje de login cuando evitamos los
                    múltiples inicios de sesión con una misma cuenta de usuario --}}
                @if(session('message_login'))
                    <div class="row justify-content-center">
                        <div class="col-xs-6 col-lg-12 col-md-12">
                            <div class="alert alert-{{ session('message_login')[0]}} text-center">
                                <h4 class="alert alert-heading">{{ __("Aviso para el usuario") }}</h4>
                                <strong>{{ session('message_login')[1] }}</strong>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="card mt-xs-3 mt-lg-5 mt-md-5" id="card-body">
                    <div class="card-header" id="card-header">
                        <h2 class="text-center text-yellow mt-xs-1 mt-lg-2 mt-md-2">{{ __('Login') }}</h2>
                    </div>

                    <div class="card-body mt-xs-4 mt-lg-5 mt-md-5 mb-xs-3 mb-lg-5 mb-md-5 text-white">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Nombre de usuario') }}</label>

                                <div class="col-md-6">
                                    <input id="username" type="username" class="form-control @error('username') is-invalid @enderror" name="username"
                                        value="{{ old('username') }}" required autocomplete="username" autofocus>

                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row pt-3">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row pt-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Recordarme') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0 pt-3">
                                <div class="col-md-8 offset-md-4">
                                    <a href="{{ route('menu_tienda') }}" class="btn btn-danger">
                                        <span class="fas fa-solid fa-arrow-left"></span>
                                        <span>{{ __('Cancelar') }}</span>
                                    </a>

                                    <button type="submit" class="btn btn-primary">
                                        <span class="fas fa-solid fa-right-to-bracket"></span>
                                        <span>{{ __('Login') }}</span>
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link text-white" href="{{ route('password.request') }}">
                                            {{ __('¿Ha olvidado su contraseña?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
