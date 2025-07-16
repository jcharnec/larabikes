@extends('layouts.master')
@php($pagina='listamotos')

@section('titulo', 'Listado Motos')

@section('contenido')

<!-- Filtro de búsqueda con grid y botones consistentes -->
<form method="GET" class="row g-2 mb-3" action="{{ route('bikes.search') }}">
    <div class="col-md-3">
        <input type="text" name="marca" class="form-control" placeholder="Marca" maxlength="16" value="{{ $marca ?? '' }}">
    </div>
    <div class="col-md-3">
        <input name="modelo" type="text" class="form-control" placeholder="Modelo" maxlength="16" value="{{ $modelo ?? '' }}">
    </div>
    <div class="col-md-2">
        <button type="submit" class="btn btn-outline-dark w-100">
            <i class="bi bi-search"></i> Buscar
        </button>
    </div>
    <div class="col-md-2">
        <a href="{{ route('bikes.index') }}" class="btn btn-outline-secondary w-100">
            <i class="bi bi-x-circle"></i> Quitar filtro
        </a>
    </div>
</form>

<!-- Botón Nueva moto alineado a la derecha -->
<div class="row mb-2">
    <div class="col-6 text-start">{{ $bikes->links() }}</div>
    <div class="col-6 text-end">
        @auth
        <a href="{{ route('bikes.create') }}" class="btn btn-outline-success">
            <i class="bi bi-plus-circle"></i> Nueva moto
        </a>
        @endauth
    </div>
</div>

<!-- Tabla de motos con cabecera estilizada -->
<div class="table-responsive">
    <table class="table table-hover table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Imagen</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Matrícula</th>
                <th>Color</th>
                <th class="text-center">Operaciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bikes as $bike)
            <tr>
                <td>{{ $bike->id }}</td>
                <td class="text-center" style="max-width: 80px">
                    <img class="rounded" style="max-width: 80%"
                        alt="Imagen de {{ $bike->marca }} {{ $bike->modelo }}"
                        title="Imagen de {{ $bike->marca }} {{ $bike->modelo }}"
                        src="{{ $bike->imagen
                        ? asset('storage/' . config('filesystems.bikesImageDir') . '/' . $bike->imagen)
                        : asset('images/bikes/default.jpg') }}">
                </td>
                <td>{{ $bike->marca }}</td>
                <td>{{ $bike->modelo }}</td>
                <td>{{ $bike->matricula }}</td>
                <td style="background-color:{{ $bike->color }}">{{ $bike->color }}</td>
                <td class="text-center">
                    <div class="btn-group">
                        <a href="{{ route('bikes.show', $bike->id) }}" class="btn btn-outline-secondary btn-sm rounded-circle" title="Ver detalles">
                            <i class="bi bi-eye"></i>
                        </a>
                        @auth
                        @if(Auth::user()->can('update', $bike))
                        <a href="{{ route('bikes.edit', $bike->id) }}" class="btn btn-outline-primary btn-sm rounded-circle" title="Editar">
                            <i class="bi bi-pencil"></i>
                        </a>
                        @endif
                        @if(Auth::user()->can('delete', $bike))
                        <a href="{{ route('bikes.delete', $bike->id) }}" class="btn btn-outline-danger btn-sm rounded-circle" title="Borrar">
                            <i class="bi bi-trash"></i>
                        </a>
                        @endif
                        @endauth
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="7" class="text-end small text-muted">
                    Mostrando {{ sizeof($bikes) }} de {{ $bikes->total() }}.
                </td>
            </tr>
        </tfoot>
    </table>
</div>
@endsection

@section('enlaces')
@parent
<a href="{{ route('bikes.index') }}" class="btn btn-outline-dark m-2">Garaje</a>
@endsection