@php($pagina='portada')

@extends('layouts.master')

@section('titulo', 'Bienvenido a LaraBikes')

@section('contenido')
<div class="container my-4">
    <!-- Hero principal -->
    <div class="position-relative mb-4 hero-banner">
        <img src="{{ asset('images/bikes/bike0.png') }}" class="img-fluid w-100 hero-image" alt="Moto de Caneda en Akira">
        <div class="overlay"></div>
        <div class="hero-text text-center text-white">
            <h1 class="display-4 fw-bold">LaraBikes</h1>
            <p class="lead">Encuentra tu moto perfecta. Explora, publica y gestiona tu garaje online.</p>
            <a href="{{ route('bikes.index') }}" class="btn btn-outline-light btn-lg mt-3">
                Ver motos
            </a>
        </div>
    </div>

    <!-- Últimas motos añadidas -->
    <h2 class="mb-4 text-center">Últimas motos añadidas</h2>
    <div class="row g-4">
        @foreach ($bikes->take(4) as $bike)
        <div class="col-12 col-sm-6 col-md-3">
            <div class="card h-100 shadow-sm">
                <img src="{{ asset('storage/images/bikes/' . $bike->imagen) }}" class="card-img-top" alt="{{ $bike->marca }}" style="object-fit: cover; height: 200px;">
                <div class="card-body">
                    <h5 class="card-title text-center">{{ $bike->marca }}</h5>
                    <p class="card-text text-center">{{ $bike->modelo }}</p>
                </div>
                <div class="card-footer text-center">
                    <a href="{{ route('bikes.show', $bike->id) }}" class="btn btn-outline-dark btn-sm">
                        <i class="bi bi-eye"></i> Ver detalles
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

@section('enlaces')
@endsection