@extends('layouts.master')

@php($pagina='borrarmoto')

@section('titulo', "Confirmar borrado de $bike->marca $bike->modelo")

@section('contenido')
<div class="my-4 border rounded p-4 bg-light">
    <h4 class="mb-3 text-danger">
        ¿Estás seguro de que quieres borrar esta moto?
    </h4>

    <figure class="text-center mb-4">
        <figcaption class="mb-2">Imagen actual:</figcaption>
        <img class="rounded img-thumbnail" style="max-width: 300px;"
            alt="Imagen de {{$bike->marca}} {{$bike->modelo}}"
            title="Imagen de {{$bike->marca}} {{$bike->modelo}}"
            src="{{ $bike->imagen
                    ? asset('storage/' . config('filesystems.bikesImageDir') . '/' . $bike->imagen)
                    : asset('images/bikes/default.jpg') }}">
    </figure>

    <form method="POST"
        action="{{ URL::temporarySignedRoute('bikes.destroy', now()->addMinutes(1), $bike->id) }}">
        @csrf
        @method('DELETE')
        <div class="text-center">
            <button type="submit" class="btn btn-outline-danger m-2">
                <i class="bi bi-trash"></i> Confirmar borrado
            </button>
            <a href="{{ route('bikes.show', $bike->id) }}" class="btn btn-outline-secondary m-2">
                <i class="bi bi-arrow-left"></i> Cancelar y volver
            </a>
        </div>
    </form>
</div>
@endsection

@section('enlaces')
@parent
<a href="{{ route('bikes.index') }}" class="btn btn-outline-dark m-2">Garaje</a>
@endsection