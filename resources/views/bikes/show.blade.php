@extends('layouts.master')

@section('titulo', "Mostrar Moto: $bike->marca $bike->modelo")

@section('contenido')
<div class="table-responsive">
    <table class="table table-hover table-striped align-middle shadow-sm">
        <tbody>
            <tr>
                <th scope="row">ID</th>
                <td>{{ $bike->id }}</td>
            </tr>
            <tr>
                <th scope="row">Marca</th>
                <td>{{ $bike->marca }}</td>
            </tr>
            <tr>
                <th scope="row">Modelo</th>
                <td>{{ $bike->modelo }}</td>
            </tr>
            <tr>
                <th scope="row">Propietario</th>
                <td>{{ $bike->user ? $bike->user->name : 'Sin propietario' }}</td>
            </tr>
            <tr>
                <th scope="row">Precio</th>
                <td>{{ $bike->precio }}</td>
            </tr>
            <tr>
                <th scope="row">Kms</th>
                <td>{{ $bike->kms }}</td>
            </tr>
            <tr>
                <th scope="row">Matriculada</th>
                <td>{{ $bike->matriculada ? 'SI' : 'NO' }}</td>
            </tr>
            @if($bike->matriculada)
            <tr>
                <th scope="row">Matrícula</th>
                <td>{{ $bike->matricula }}</td>
            </tr>
            @endif
            @if($bike->color)
            <tr>
                <th scope="row">Color</th>
                <td style="background-color: {{ $bike->color }};">{{ $bike->color }}</td>
            </tr>
            @endif
            <tr>
                <th scope="row">Imagen</th>
                <td class="text-start">
                    <img class="rounded img-fluid"
                        style="max-width:400px"
                        alt="Imagen de {{ $bike->marca }} {{ $bike->modelo }}"
                        title="Imagen de {{ $bike->marca }} {{ $bike->modelo }}"
                        src="{{ $bike->imagen
                            ? asset('storage/' . config('filesystems.bikesImageDir') . '/' . $bike->imagen)
                            : asset('images/bikes/default.jpg') }}">
                </td>
            </tr>
        </tbody>
    </table>
</div>

<div class="text-end my-3">
    <div class="btn-group" role="group" aria-label="Operaciones">
        <a href="{{ route('bikes.edit', $bike->id) }}" class="btn btn-outline-primary btn-sm" title="Editar">
            <i class="bi bi-pencil"></i>
        </a>
        <a href="{{ route('bikes.delete', $bike->id) }}" class="btn btn-outline-danger btn-sm" title="Borrar">
            <i class="bi bi-trash"></i>
        </a>
    </div>
</div>
@endsection

@section('enlaces')
@parent
<a href="{{ route('bikes.index') }}" class="btn btn-outline-dark m-2">Garaje</a>
@endsection