<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
    <meta name="google" content="notranslate">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="google" content="notranslate"/>
    <meta name="verify-paysera" content="abd02ea22772c55bec6eccf85e74b33e">
    <meta name="application-name" content="Landgame">
    <link rel="icon" href="{{ asset('images/logo_tienda.png') }}"/>
    <title data-rh="true">Landgame | Venta de juegos de mesa</title>
    <meta data-rh="true" name="description" content="Landgame: Obtenga todos los juegos de mesa existentes hasta la fecha. Con nuestro estilo Landgame."/>
    <meta data-rh="true" property="og:url" content=""/>
    <meta data-rh="true" property="og:type" content="website"/>
    <meta data-rh="true" property="og:title" content="Landgame | Venta de juegos de mesa para explorar y comprar"/>
    <meta data-rh="true" property="og:image" content=""/>
    <meta data-rh="true" property="og:description" content="Landgame: la mejor tienda de juegos de mesa de España. Con nuestro estilo Landgame."/>
    <meta data-rh="true" property="og:site_name" content="LANDGAME"/>
    <link data-rh="true" rel="canonical" href="#"/>
    <meta name="apple-mobile-web-app-title" content="LANDGAME"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="default"/>

    {{-- CSS Menú principal Landgame y del modal --}}
    <link rel="stylesheet" href="{{ asset('css/menu_tienda.css') }}">

    {{-- CSS para nuestro banner --}}
    <link rel="stylesheet" href="{{ asset('css/banner.css') }}">

    {{-- CSS Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    {{-- FontAwesome 6.2.0 --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
  </head>

  <body>
    {{-- Para visualizar en primer lugar un banner o ventana de publicidad, cuando el cliente no haya iniciado sesión --}}
    @guest
      <div class="banner_landgame sticky-top" id="banner">
        <div class="container_cerrar">
          <h3>
            <a href="{{ route('menu_tienda') }}" class="text-decoration-none" onclick="exitBanner(); return false;">
              <span class="text-white">X</span>
            </a>
          </h3>
        </div>

        {{-- Para mostrar el fondo del contenedor --}}
        <aside class="responsive-banner">
          <img src="{{ asset('images/juegos_mesa/trivial_pursuit_familia.png') }}" alt="Trivial Pursuit Familia"/>

          <div class="container-envelope">
            <h4 class="text-center">Juego de mesa más barato y en oferta</h4>
            <span class="text-left text-white">Ahorrate un 21% en este Trivial, ¡¡hazte con el!!</span>
          </div>
        </aside>
      </div>
    @endguest

    <div id="app">
      <header>
        {{-- Reutilizamos nuestro header como componente --}}
        <x-header/>

        {{-- Siguiente navbar del mercado --}}
        <div class="pl-5">
          <nav class="navbar navbar-expand-md navbar_menu">
            <div class="collapse navbar-collapse row ps-4">
              <ul class="navbar-nav">
                <li class="nav-item col-4 navbar_second"></li>
                <li class="nav-item col-md-1">
                  <a class="nav-link text-decoration-none text-white" id="texto" aria-current="page" href="#">Mercado</a>
                </li>
                <li class="nav-item col-md-1">
                  <a class="nav-link text-decoration-none text-white" id="texto" aria-current="page" href="#">Ver tipos</a>
                </li>
                <li class="nav-item col-md-1">
                  <a class="nav-link text-decoration-none text-white" id="texto" aria-current="page" href="#">Tarjetas de regalo</a>
                </li>
              </ul>
            </div>
          </nav>
        </div>
      </header>

      {{-- Mensaje por realizar el pago por PayPal --}}
      @if(session('paymentStatus'))
        <div class="alert alert-{{ session('paymentStatus')[0] }} text-center">
            {{ session('paymentStatus')[1] }}
        </div>
      @endif

      {{-- Mensaje después de editar el perfil del propio cliente logueado --}}
      @if(session('mensaje_perfil'))
        <div class="alert alert-{{ session('mensaje_perfil')[0] }} text-center">
            {{ session('mensaje_perfil')[1] }}
        </div>
      @endif

      <main>

        {{-- Aquí tenemos los juegos de mesa --}}
        <div class="container-fluid container_juegos">
          <div class="pt-3">
            <h1 class="text-left text-white p-5 titulo">Nuestros juegos de mesa</h1>
          </div>

          <div class="row row-cols-lg-4 p-5 compra">
            @if ($juegos->count())
              @foreach($primerosJuegos as $juegoMesa)
              <div class="mb-xs-2 mb-lg-4 mb-md-4">
                <div class="card tarjeta_juego h-100 mb-xs-3 mb-lg-5 mb-md-5">
                  {{-- Imágenes responsive para nuestros juegos de mesa --}}
                  @foreach ($imagenes as $imagen)
                    @if ($juegoMesa->id == $imagen->juego_id)
                      <div class="bg-white rounded d-lg-flex d-md-flex justify-content-center">
                        <img class="img-fluid w-100 card-img-top mt-3 medidas_imagen" loading="lazy" src="{{ asset($imagen->url) }}" draggable="false"
                          decoding="async" alt="Juego de Landgame" data-text="Error al mostrar esta imagen."
                          data-text-short="No se pudo cargar la imagen"/>
                      </div>
                    @endif
                  @endforeach

                  <div class="card-body color_footer rounded">
                    <p class="card-text text-warning">Nombre: <span class="text-white">{{ $juegoMesa->nombre }}</span></p>
                    <p class="card-text"><p class="text-warning">Descripción:</p> <span class="text-white">{{ $juegoMesa->descripcion }}</span></p>
                    <p class="card-text text-warning">Precio: <span class="text-white">{{ $juegoMesa->precio }} €</span></p>

                    @auth
                      {{-- Visualizamos este botón cuando un cliente inicia sesión --}}
                      <a href="{{ route('cliente.carrito', $juegoMesa->id) }}" class="btn btn-warning mt-4">
                        <span class="fas fa-solid fa-eye"></span>
                        <span>Ver juego</span>
                      </a>
                    @endauth
                  </div>
                </div>
              </div>
              @endforeach

              {{-- Para el botón de mostrar más --}}
              <div class="d-flex justify-content-center row cols-xs-2 cols-lg-5 cols-md-5 m-md-4">
                <button class="btn btn-outline text-white container_juegos border border-white"
                  id="btnJuegos" data-toggle="collapse" data-target="#juegos"
                  onclick="mostrarJuegos();">
                  Mostrar más
                </button>
              </div>
            @else
              <div class="alert alert-warning text-center m-3">
                <span>Juegos de mesa no encontrados en Landgame</span>
              </div>
            @endif
          </div>

          <div id="juegos">
            <div class="row row-cols-lg-4 p-5 compra">
              @foreach($masJuegos as $juegoMesa)
              <div class="mb-xs-2 mb-lg-4 mb-md-4">
                <div class="card tarjeta_juego h-100 mb-xs-3 mb-lg-5 mb-md-5">
                  @foreach ($imagenes as $imagen)
                    @if ($juegoMesa->id == $imagen->juego_id)
                      <div class="bg-white rounded d-lg-flex d-md-flex justify-content-center">
                        <img class="img-fluid card-img-top mt-3 medidas_imagen" loading="lazy" src="{{ asset($imagen->url) }}" draggable="false"
                          decoding="async" alt="Juego de Landgame" data-text="Error al mostrar esta imagen."
                          data-text-short="No se pudo cargar la imagen"/>
                      </div>
                    @endif
                  @endforeach

                  <div class="card-body color_footer rounded">
                    <p class="card-text text-warning">Nombre: <span class="text-white">{{ $juegoMesa->nombre }}</span></p>
                    <p class="card-text text-warning">Descripción: <span class="text-white">{{ $juegoMesa->descripcion }}</span></p>
                    <p class="card-text text-warning">Precio: <span class="text-white">{{ $juegoMesa->precio }} €</span></p>

                    @auth
                      {{-- Visualizamos el botón cuando un cliente ha iniciado sesión (en teoría) --}}
                      <a href="{{ route('cliente.carrito', $juegoMesa->id) }}" class="btn btn-warning mt-4">
                        <span class="fas fa-solid fa-eye"></span>
                        <span>Ver juego</span>
                      </a>
                    @endauth
                  </div>
                </div>
              </div>
              @endforeach
            </div>
          </div>
        </div>
      </main>

      {{-- Aquí mostramos el footer como otro componente --}}
      <x-footer/>
    </div>

    {{-- JS Bootstrap v5 --}}
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>

    {{-- Para el banner flotante --}}
    <script type="text/javascript" src="{{ asset('js/banner_flotante.js') }}"></script>

    {{-- Para mostrar u ocultar juegos --}}
    <script type="text/javascript" src="{{ asset('js/lista_juegos.js') }}"></script>
  </body>
</html>
