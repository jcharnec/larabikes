@extends('layouts.master')

@section('titulo', 'Error 503 - Servicio no disponible')

@section('contenido')
<div class="container d-flex flex-column justify-content-center align-items-center py-5">
    <div class="text-center bg-white p-5 rounded shadow">
        <h1 class="display-4 text-warning">503 Servicio no disponible</h1>
        <p class="lead text-muted mt-3">
            Estamos arreglando cosillas. Vuelve a intentarlo en un momento. 😃
        </p>
        <a href="{{ route('welcome') }}" class="btn btn-outline-dark mt-4">Ir al inicio</a>
    </div>
</div>
@endsection

@section('enlaces')
<a href="{{ route('bikes.index') }}" class="btn btn-outline-dark m-2">Garaje</a>
<a href="{{ route('welcome') }}" class="btn btn-outline-dark m-2">Inicio</a>
@endsection