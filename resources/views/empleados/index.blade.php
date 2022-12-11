@extends('inicio')

@section('titulo', 'Listado de empleados')

@section('usuarios_landgame')

<div class="mt-3 ml-4">
    <span class="text-white">Administración / Empleados</span>
</div>

<h1 class="mt-5 ml-4 mb-5">Empleados</h1>

<a href="{{ route('empleados.create') }}" class="btn btn-success ml-4">
    <span class="fas fa-solid fa-user-plus"></span>
    <span>Añadir empleado</span>
</a>

{{-- Mensaje flash para el CRUD Empleados tanto para los contables como los mozos de almacén --}}
@if (session('mensaje_empleado'))
<div class="alert alert-{{ session('mensaje_empleado')[0] }} ml-4 mt-4 mb-1 text-center">
    {{ session('mensaje_empleado')[1] }}
</div>
@endif

{{-- Mostramos el número total de empleados contables y mozos --}}
<div class="bg-info col-offset-4 ml-4 p-3 mt-4 rounded">
    <span class="text-white">
        <span>Empleados en total: {!! $empleados->count() !!}</span>
    </span>
</div>

<div class="bg-white border border-1 rounded pl-4 pr-4 pt-2 pb-3 ml-4 mt-4">
    <table class="table table-bordered text-center mt-3">
        <thead class="table table-light">
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Apellidos</th>
                <th scope="col">Email</th>
                <th scope="col">Nombre de usuario</th>
                <th scope="col">Rol Empleado</th>
                <th scope="col" colspan="2">Operaciones</th>
            </tr>
        </thead>
        <tbody>
            @if($empleados->count())
            @foreach ($empleados as $empleado)
                <tr>
                    <td>{{ $empleado->nombre }}</td>
                    <td>{{ $empleado->apellidos }}</td>
                    <td>{{ $empleado->email }}</td>
                    <td>{{ $empleado->username }}</td>
                    <td>{{ $empleado->role->nombre }}</td>
                    <td>
                        <a href="{{ route('empleados.edit', $empleado->id) }}" type="submit" class="btn btn-primary">
                            <span class="fas fa-solid fa-pencil"></span>
                            <span class="text-white">Editar</span>
                        </a>
                    </td>
                    <td>
                        <button class="btn btn-danger" onclick="eliminar('{{ $empleado->id }}', '{{ $empleado->username }}', '{{ $empleado->role_id }}')">
                            <span class="fas fa-solid fa-trash-can"></span>
                            <span>Eliminar</span>
                        </button>
                    </td>
                </tr>
            @endforeach
            @else
                <tr>
                    <td colspan="7">
                        <div class="alert alert-warning">
                            <span>Empleados no encontrados en Landgame</span>
                        </div>
                    </td>
                </tr>
            @endif
        </tbody>
    </table>

    {{-- Mostramos 5 empleados por cada paginación --}}
    <div class="pagination pagination-md mt-4">
        {!! $empleados->links() !!}
    </div>
</div>

{{-- Mensaje de confirmación de JS con SweetAlert 2 antes de eliminar empleado --}}
<link rel="stylesheet" href="sweetalert2.min.css">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="sweetalert2.min.js"></script>
<script src="{{ asset('js/eliminar_empleado.js') }}"></script>

@endsection