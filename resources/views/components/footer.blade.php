<div>
    {{-- CSS Menú principal Landgame y del modal --}}
    <link rel="stylesheet" href="{{ asset('css/menu_tienda.css') }}">

    {{-- CSS Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    {{-- FontAwesome 6.2.0 --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <footer class="color_footer bd-footer py-4">
        <div class="container py-4 py-md-5 px-4 px-md-3">
            <div class="row">
                <div class="col-lg-3 mb-3 text-white">
                {{-- Logo de la tienda en el pie de página --}}
                <img src="{{ asset('images/logo_tienda.png') }}" class="w-50 h-50" alt="Logo de Landgame Footer"/>
                <a class="d-inline-flex align-items-center mb-2 link-dark text-decoration-none" href="#">
                    <h3>
                    <strong class="text-primary">Land</strong> <span class="text-white">game</span>
                    </h3>
                </a>
                <ul class="list-unstyled small text-muted">
                    <li class="mb-2 text-white">
                    <span>Copyright © 2022 Landgame. Todos los derechos reservados.</span>
                    </li>
                    <li class="mb-2 text-white">Versión 1.0.0</li>
                </ul>
                </div>
            </div>
        </div>
    </footer>
</div>
