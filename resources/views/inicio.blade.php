@extends ('layouts.app')

<title> @yield('titulo') </title>
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

{{-- Para todas nuestras plantillas de administración, mozo y contable --}}
@section('content')
@parent
{{-- Parte del header de administración --}}

<nav class="navbar navbar-expand-lg navbar-dark text-outline" id="navbar">
    <div class="container-fluid">
        <span>
            <img src="{{ asset('images/logo_tienda.png') }}" class="img-fluid mr-3" id="logo" alt="Logo de tienda"/>
            <a href="{{ route('admin.main') }}" style="text-decoration: none;">
                <span class="text-white mt-2" id="logo_titulo">Land</span><span class="text-primary mt-2" id="logo_titulo">game</span>
            </a>
        </span>

        <div class="align-content-end" id="navbarNavDropdown">
            <ul class="navbar-nav">
                {{-- Menú desplegable para el logout --}}
                <li class="nav-item">
                    <div class="dropdown">
                        <button class="btn btn-dark dropdown-toggle text-white mr-3 mt-1 border-0" type="button" id="cabecera" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->username }}
                        </button>
                        <div class="dropdown-menu dropdown-menu-right bg-dark text-white" aria-labelledby="dropdownmenu">
                            <a class="dropdown-item text-white" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">

                                <span class="fas fa-solid fa-right-from-bracket mr-2"></span>
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <img src="{{ asset('images/user_admin.png') }}" class="img-thumbnail" id="perfil" alt="Imágen admin"/>
                </li>
            </ul>
        </div>
    </div>
  </nav>

  {{-- Parte lateral de administración --}}
  <div class="container-fluid">
    <div class="row flex-nowrap">
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 mt-4 min-vh-100 text-white">
                <form class="d-flex mt-3" role="search">
                    <button class="btn btn-outline-light" type="submit">
                        <span class="fas fa-search"></span>
                      </button>
                  <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                </form>

                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start mt-3">
                    @if (Auth::user()->role_id == 1)
                    <li class="link_admin">
                        <div class="option text-white">
                            <a href="{{ route('admin.main') }}" data-bs-toggle="collapse" class="nav-link px-0 align-middle" id="link_admin">
                                <span class="fas fa-regular fa-gauge-high text-white mt-3 mb-4"></span>
                                <span class="ms-1 d-none d-sm-inline text-white ml-3">Dashboard</span>
                            </a>
                        </div>
                    </li>
                    <li class="link_admin">
                        <div class="option text-white">
                            <a href="{{ route('juegos.index') }}" data-bs-toggle="collapse" class="nav-link px-0 align-middle" id="link_admin">
                                <span class="fas fa-sharp fa-solid fa-book text-white mt-3 mb-4"></span>
                                <span class="ms-1 d-none d-sm-inline text-white ml-3">Catálogo</span>
                            </a>
                        </div>
                    </li>
                    <li class="link_admin">
                        <div class="option text-white">
                            <a href="{{ route('clientes.index') }}" data-bs-toggle="collapse" class="nav-link px-0 align-middle" id="link_admin">
                                <span class="fas fa-solid fa-users text-white mt-3 mb-4"></span>
                                <span class="ms-1 d-none d-sm-inline text-white ml-2">Clientes</span>
                            </a>
                        </div>
                    </li>
                    <li class="link_admin">
                        <div class="option text-white">
                            <a href="{{ route('empresas_reparto.index') }}" data-bs-toggle="collapse" class="option nav-link px-0 align-middle" id="link_admin">
                                <span class="fas fa-duotone fa-truck text-white mt-3 mb-4"></span>
                                <span class="ms-1 d-none d-sm-inline text-white ml-2">Empresas de reparto</span>
                            </a>
                        </div>
                    </li>
                    <li class="link_admin">
                        <div class="option text-white">
                            <a href="{{ route('empleados.index') }}" data-bs-toggle="collapse" class="option nav-link px-0 align-middle" id="link_admin">
                                <span class="fas fa-solid fa-users text-white mt-3 mb-4"></span>
                                <span class="ms-1 d-none d-sm-inline text-white ml-2">Empleados</span>
                            </a>
                        </div>
                    </li>
                    <li class="link_admin">
                        <div class="option text-white">
                            <a href="{{ route('admin.pedidos') }}" data-bs-toggle="collapse" class="nav-link px-0 align-middle" id="link_admin">
                                <span class="fas fa-sharp fa-solid fa-credit-card text-white mt-3 mb-4"></span>
                                <span class="ms-1 d-none d-sm-inline text-white ml-3">Pedidos</span>
                            </a>
                        </div>
                    </li>
                    <li class="link_admin">
                        {{-- Botón de menú desplegable --}}
                        <div class="option dropright text-white">
                            <span class="fas fa-solid fa-gear text-white mt-3 mb-4"></span>
                            <span class="ms-1 d-none d-sm-inline text-white ml-2">Administración</span>
                            {{-- Submenú --}}
                            <button class="btn btn-dark dropdown-toggle text-white" type="button" id="dropdownmenu"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                            <div class="dropdown-menu dropdown-menu-right bg-dark" aria-labelledby="dropdownmenu">
                                <a href="{{ route('admin.menus') }}" class="dropdown-item bg-dark text-white">Menus</a>
                            </div>
                        </div>
                    </li>
                    @endif

                    @if (Auth::user()->role_id == 2)
                    <li class="link_admin">
                        <div class="option text-white">
                            <a href="{{ route('contable.pedidos') }}" data-bs-toggle="collapse" class="option nav-link px-0 align-middle" id="link_admin">
                                <span class="fas fa-solid fa-book-open text-white mt-4 mb-4"></span>
                                <span class="ms-1 d-none d-sm-inline text-white ml-2">Libro de finanzas</span>
                            </a>
                        </div>
                    </li>
                    @else
                        @if(Auth::user()->role_id == 3)
                            <li class="link_admin">
                                <div class="option text-white">
                                    <a href="{{ route('mozo.pedidos') }}" data-bs-toggle="collapse" class="nav-link px-0 align-middle" id="link_admin">
                                        <span class="fas fa-sharp fa-solid fa-credit-card text-white mt-3 mb-4"></span>
                                        <span class="ms-1 d-none d-sm-inline text-white ml-3">Pedidos</span>
                                    </a>
                                </div>
                            </li>
                        @endif
                    @endif
                </ul>
            </div>
        </div>

        {{-- Páginas de administración heredadas (sintáxis de Laravel 7) --}}
        <div class="container-fluid align-content-center">
            @if(Auth::user()->role_id == 1)
                {{-- Página inicial de administrador y menús --}}
                @yield('main_admin')
                @yield('menus')

                {{-- Listados de clientes y empleados --}}
                @yield('usuarios_landgame')

                {{-- Listado de juegos de mesa y empresas de reparto --}}
                @yield('juegos_mesa')
                {{-- Listado de empresas de reparto --}}
                @yield('empresas')

                {{-- Para que el administrador pueda gestionar los pedidos --}}
                @yield('pedidos_admin')
            @else
                @if(Auth::user()->role_id == 2)
                    {{-- Para las vistas del contable --}}
                    @yield('main_contable')

                    {{-- Para realizar búsqueda de pedidos --}}
                    @yield('pedidos_contable')
                @endif

                @if(Auth::user()->role_id == 3)
                    {{-- Para las vistas del mozo --}}
                    @yield('main_mozo')

                    {{-- Visualizar los pedidos de todos los clientes --}}
                    @yield('pedidos_mozo')
                @endif

                @if(Auth::user()->role_id == 4)
                    {{-- Para las vistas del cliente --}}
                    @yield('main_cliente')
                @endif

            @endif
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
@endsection
