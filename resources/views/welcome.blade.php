@env(['local', 'test'])
    <x-local :mode="App::environment()"/>
@endenv

@php($pagina='portada')

@extends('layouts.master')

@section('titulo', 'Portada de Larabikes')

@section('login')
@endsection

@section('contenido')
<figure class="row mt-2 mb-2 col-10 offset-1">
    <img class="d-block w-100" alt="Moto de Caneda en Akira" src="{{ asset('images/bikes/bike0.png') }}">
</figure>

<div class="row mt-2 mb-2 col-10 offset-1">
    @foreach ($bikes as $bike)
        <div class="col-md-4">
            <figure>
                <img class="d-block w-100" alt="{{ $bike->marca }}" src="{{ asset('storage/images/bikes/' . $bike->imagen) }}">
                <figcaption>{{ $bike->marca }}</figcaption>
            </figure>
        </div>
    @endforeach
</div>
@endsection

@section('enlaces')
@endsection

