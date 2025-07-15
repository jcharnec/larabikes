@extends('layouts.master')

@section('titulo', 'Verificación de correo electrónico')

@section('contenido')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-dark text-white">
                    <i class="bi bi-envelope-check"></i> Verifica tu correo electrónico
                </div>

                <div class="card-body bg-light">
                    @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        <i class="bi bi-check-circle-fill"></i>
                        Se ha enviado un nuevo enlace de verificación a tu correo electrónico.
                    </div>
                    @endif

                    <p class="mb-3">
                        Antes de continuar, revisa tu correo electrónico para encontrar el enlace de verificación.
                    </p>
                    <p>
                        Si no has recibido el correo electrónico, puedes solicitar otro:
                    </p>

                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-outline-dark">
                            <i class="bi bi-arrow-repeat"></i> Reenviar correo de verificación
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection