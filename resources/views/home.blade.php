@extends('layouts.app')
@section('title', 'Inicio')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}

                </div>
            </div>

            {{-- Esta parte es donde cada botón es visible por un rol de usuario determinado --}}
            <div class="card-body">
                @if(Auth::user()->role_id == 2)
                    <a href="#" class="btn btn-success mt-3">
                        <span class="fas fa-sharp fa-solid fa-user-tie"></span>
                        <span>Usuario contable</span>
                    </a>
                @else

                    @if(Auth::user()->role_id == 3)
                        <a href="#" class="btn btn-secondary mt-3">
                            <span class="fas fa-solid fa-user-large"></span>
                            <span>Usuario mozo</span>
                        </a>
                    @endif

                    @if(Auth::user()->role_id == 4)
                        <a href="#" class="btn btn-warning mt-3">
                            <span class="fas fa-solid fa-user"></span>
                            <span>Usuario cliente</span>
                        </a>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
