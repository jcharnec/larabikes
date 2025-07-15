@extends('layouts.master')

@section('titulo', 'Error 403 - Prohibido')

@section('contenido')
<div class="container d-flex flex-column justify-content-center align-items-center py-5">
    <div class="text-center bg-white p-5 rounded shadow">
        <h1 class="display-4 text-danger">403 Prohibido</h1>
        <p class="lead text-muted mt-3">
            {{ $exception->getMessage() ?: 'No tienes permiso para acceder a esta página.' }}
        </p>
        <a href="{{ url()->previous() }}" class="btn btn-outline-dark mt-4">Volver atrás</a>
    </div>
</div>
@endsection

@section('enlaces')
<a href="{{ route('bikes.index') }}" class="btn btn-outline-dark m-2">Garaje</a>
<a href="{{ route('welcome') }}" class="btn btn-outline-dark m-2">Inicio</a>
@endsection