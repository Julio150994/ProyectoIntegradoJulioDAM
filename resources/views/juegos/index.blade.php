@extends('inicio')

@section('titulo', 'Catálogo de juegos de mesa')

<link rel="stylesheet" href="{{ asset('css/juegos.css') }}">

@section('juegos_mesa')

<div class="mt-3 ml-4">
    <span class="text-white">Administración / Catálogo</span>
</div>

<h1 class="mt-5 ml-4 mb-5">Catálogo de juegos</h1>

<a href="{{ route('juegos.create') }}" class="btn btn-success ml-4 mb-4">
    <span class="fas fa-solid fa-user-plus"></span>
    <span>Añadir juego</span>
</a>

{{-- Mensaje flash para el CRUD Juegos --}}
@if (session('mensaje_juego_mesa'))
<div class="alert alert-{{ session('mensaje_juego_mesa')[0] }} ml-4 mt-4 mb-1 text-center">
    {{ session('mensaje_juego_mesa')[1] }}
</div>
@endif

{{-- Mostramos el total de los juegos de mesa --}}
<div class="bg-info col-offset-4 ml-4 p-3 rounded">
    <span class="text-white">
        <span>Juegos de mesa en total: {!! $juegos->total() !!}</span>
    </span>
</div>

<div class="bg-white border border-1 rounded pl-4 pr-4 pt-2 pb-3 ml-4 mt-4">
    <table class="table table-bordered text-center mt-3">
        <thead class="table table-light">
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Descripción</th>
                <th scope="col">Precio (unidad)</th>
                <th scope="col">Imágenes</th>
                <th scope="col" colspan="2">Operaciones</th>
            </tr>
        </thead>
        <tbody>
            {{-- Contamos los juegos existentes en Landgame --}}
            @if($listaJuegos->count())
            @foreach ($juegos as $juegoMesa)
                <tr>
                    <td>{{ $juegoMesa->nombre }}</td>
                    <td>{{ $juegoMesa->descripcion }}</td>
                    <td class="pl-xs-1 pl-lg-2 pl-md-2">{{ $juegoMesa->precio }} €</td>
                    <td>
                        @foreach($listaJuegos as $imagen)
                            {{-- Condicional para mostrar las imágenes que correspondan a cada juego de mesa --}}
                            @if($juegoMesa->id == $imagen->juego_id)
                                <img class="w-25 h-25" src="{{ asset($imagen->url) }}" loading="lazy" alt="Imágen"
                                    data-text="Error al mostrar esta imagen."
                                    data-text-short="Error al cargar la imagen"/>
                            @endif
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('juegos.edit', $juegoMesa->id) }}" type="submit" class="btn btn-primary">
                            <span class="fas fa-pencil text-white"></span>
                            <span class="text-white">Editar</span>
                        </a>
                    </td>
                    <td>
                        <button class="btn btn-danger" type="submit" onclick="eliminar('{{ $juegoMesa->id }}', '{{ $juegoMesa->nombre }}')">
                            <span class="fas fa-solid fa-trash-can"></span>
                            <span>Eliminar</span>
                        </button>
                    </td>
                </tr>
            @endforeach
            @else
                <tr>
                    <td colspan="6">
                        <div class="alert alert-warning">
                            <span>Juegos de mesa no encontrados en Landgame</span>
                        </div>
                    </td>
                </tr>
            @endif
        </tbody>
    </table>

    {{-- Mostramos 5 juegos por cada paginación --}}
    <div class="pagination pagination-md mt-4">
        {!! $juegos->links() !!}
    </div>
</div>

{{-- Mensaje de confirmación de JS con SweetAlert 2 antes de eliminar juego --}}
<link rel="stylesheet" href="sweetalert2.min.css">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="sweetalert2.min.js"></script>
<script type="text/javascript" src="{{ asset('js/eliminar_juego.js') }}"></script>

@endsection