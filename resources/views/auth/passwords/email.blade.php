@extends('layouts.app')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/login.css') }}">

@section('content')
<div class="main-login container-fluid pt-xs-2 pt-lg-4 pt-md-4 pb-xs-2 pb-lg-4 pb-md-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card mt-xs-3 mt-lg-5 mt-md-5" id="card-body">
                <div class="card-header" id="card-header">
                    <h2 class="text-center text-yellow mt-xs-1 mt-lg-2 mt-md-2">{{ __('Reinicio de Contraseña') }}</h2>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="card-body mt-xs-4 mt-lg-5 mt-md-5 mb-xs-3 mb-lg-5 mb-md-5">
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div class="form-group row text-white">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email de usuario') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0 pt-3">
                                <div class="col-md-8 offset-md-4">
                                    <a href="{{ route('login') }}" class="btn btn-danger">
                                        <span class="fas fa-solid fa-arrow-left"></span>
                                        <span>{{ __('Cancelar') }}</span>
                                    </a>

                                    <button type="submit" class="btn btn-primary">
                                        <span class="fas fa-solid fa-paper-plane"></span>
                                        <span>{{ __('Enviar email para restablecer contraseña') }}</span>
                                    </button>
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
