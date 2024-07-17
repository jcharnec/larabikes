@env(['local', 'test'])
    <x-local :mode="App::environment()"/>
@endenv

@php($pagina='portada')

@extends('layouts.master')

@section('titulo', 'Portada de Larabikes')

@section('login')
@endsection

@section('contenido')
<style>
    .bike-image {
        width: 100%;
        height: 250px; /* Ajusta esta altura según tus necesidades */
        object-fit: cover; /* Esto asegurará que la imagen se recorte para llenar el contenedor */
    }
</style>

<figure class="row mt-2 mb-2 col-10 offset-1">
    <img class="d-block w-100" alt="Moto de Caneda en Akira" src="{{ asset('images/bikes/bike0.png') }}">
</figure>

<div class="row mt-2 mb-2 col-10 offset-1">
    <div class="col-12">
        <div class="row">
            @foreach ($bikes->take(4) as $bike)
                <div class="col-md-3">
                    <figure>
                        <img class="bike-image" alt="{{ $bike->marca }}" src="{{ asset('storage/images/bikes/' . $bike->imagen) }}">
                        <figcaption>{{ $bike->marca }}</figcaption>
                    </figure>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('enlaces')
@endsection
