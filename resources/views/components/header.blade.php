<div>
    {{-- CSS Menú principal Landgame y del modal --}}
    <link rel="stylesheet" href="{{ asset('css/menu_tienda.css') }}">

    {{-- CSS Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    {{-- FontAwesome 6.2.0 --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <div class="container_juegos">
        <nav class="navbar navbar-expand-lg text-white flex-wrap flex-lg-nowrap">
          <div class="container-xxl">
            <a class="navbar-brand" href="{{ route('menu_tienda') }}">
              <img src="{{ asset('images/logo_tienda.png') }}" class="w-25 h-25" alt="Logo de Landgame" class="logo"/>
              <span class="text-white">Landgame</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
          </div>

          <div class="col-md-3 mr-5">
           {{--  <form action="#" class="d-flex" role="search" method="GET">
              @csrf

              <input class="form-control me-2" type="search" placeholder="Buscar por nombre de juego" aria-label="Buscar">
              <button class="btn btn-outline-dark" type="submit">
                <span class="fas fa-sharp fa-solid fa-magnifying-glass"></span>
              </button>
            </form> --}}
          </div>

          <div class="container-fluid">
            <div class="container"></div>

            {{-- Para cuando hemos iniciado sesión con el cliente --}}
            @auth
            {{-- <div class="container">
              <div class="row align-items-start">
                <div class="col"></div>
                <div class="col">
                  <ul class="navbar-nav">
                    <li class="nav-item">
                      <a class="nav-link active text-white" id="texto" aria-current="page" href="{{ route('cliente.compra') }}">
                        <span class="fas fa-solid fa-cart-shopping"></span>
                      </a>
                    </li>
                  </ul>
                </div>
                <div class="col"></div>
              </div>
            </div> --}}

            <div class="btn-group m-lg-5 m-md-5">
              <button type="button" class="btn btn-primary dropdown-toggle border-0 mr-auto" id="link_cliente" data-bs-toggle="dropdown" aria-expanded="false">
                {{ Auth::user()->username }}
              </button>
              <ul class="dropdown-menu" id="lista_cliente">
                <li id="link_cliente">
                  {{-- Editar perfil del propio cliente con el que hemos iniciado sesión --}}
                  <a class="dropdown-item text-white" href="{{ route('cliente.perfil') }}" id="link_cliente">
                      <span class="fas fa-solid fa-user-edit mr-2"></span>
                      <span>{{ __('Editar perfil') }}</span>
                  </a>
                </li>

                <li id="link_cliente">
                  {{-- Editar cuenta bancaria de cliente --}}
                  {{-- <a class="dropdown-item text-white" href="#" id="link_cliente">
                      <span class="fas fa-sharp fa-solid fa-credit-card mr-2"></span>
                      <span>{{ __('Editar cuenta bancaria') }}</span>
                  </a> --}}
                </li>

                <li id="link_cliente">
                  <a class="dropdown-item text-white" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();" id="link_cliente">
                      <span class="fas fa-solid fa-right-from-bracket mr-2"></span>
                      <span>{{ __('Logout') }}</span>
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
                  </form>
                </li>
              </ul>
            </div>
            @endauth

            {{-- Para cuando no hemos iniciado sesión con ningún usuario --}}
            @guest
              <div class="container">
                <ul class="navbar-nav">
                  <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('login') }}" id="texto">
                      <span class="fas fa-solid fa-right-to-bracket"></span>
                      <span>{{ __('Login') }}</span>
                    </a>
                  </li>
                  <div class="col"></div>
                  <li class="nav-item">
                    <div class="container-md">
                      <a class="nav-link text-white" href="{{ route('register') }}" id="texto">
                        <span class="fas fa-solid fa-user-plus"></span>
                        <span>{{ __('Registro') }}</span>
                      </a>
                    </div>
                  </li>
                  <div class="col"></div>
                </ul>
              </div>
            @endguest
          </div>
        </nav>
    </div>
</div>
