@extends('layouts.master')

@section('contenido')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Mi perfil') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('Identificado correctamente') }}
                    <div>
                        <h4>Información de usuario:</h4>
                        <p>Nombre: {{ $users->name }}</p>
                        <p>Correo: {{ $users->email }}</p>
                        <p>Fecha de registro: {{ $users->created_at }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection