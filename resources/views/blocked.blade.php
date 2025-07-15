@extends('layouts.master')

@section('titulo', 'Acceso bloqueado')

@section('contenido')
<div class="container my-5">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-8">
            <div class="alert alert-danger text-center p-4">
                <h4 class="alert-heading mb-3">⚠️ Has sido <strong>bloqueado</strong></h4>
                <p>Un administrador ha restringido tu acceso temporalmente.</p>
                <p class="mb-3">Si crees que se trata de un error o quieres conocer los motivos, puedes contactarnos:</p>
                <a href="{{ route('contacto') }}" class="btn btn-outline-dark">
                    <i class="bi bi-envelope"></i> Formulario de contacto
                </a>
            </div>
        </div>
        <div class="col-md-4 text-center">
            <img src="{{ asset('/images/template/blocked.png') }}"
                alt="Usuario bloqueado"
                class="img-fluid rounded shadow-sm mb-2">
            <figcaption class="figure-caption text-muted">Usuario bloqueado</figcaption>
        </div>
    </div>
</div>
@endsection