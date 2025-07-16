@extends('layouts.master')

@section('contenido')
<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            @if (Auth::user()->email_verified_at === null)
            <div class="alert alert-warning d-flex align-items-center" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <div>
                    Antes de continuar, confirma tu correo electrónico.
                    Si no lo has recibido, haz clic aquí para solicitar otro:
                </div>
                <form method="POST" action="{{ route('verification.send') }}" class="ms-2">
                    @csrf
                    <button type="submit" class="btn btn-outline-warning btn-sm">
                        <i class="bi bi-envelope"></i> Reenviar
                    </button>
                </form>
            </div>
            @endif

            <div class="card shadow-sm bg-light mb-4">
                <div class="card-header fw-bold">
                    <i class="bi bi-person-circle"></i> Mi perfil
                </div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <p class="mb-3 text-success fw-semibold">
                        <i class="bi bi-check-circle-fill"></i> Identificado correctamente
                    </p>

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>Nombre:</strong> {{ $users->name }}</li>
                        <li class="list-group-item"><strong>Correo:</strong> {{ $users->email }}</li>
                        <li class="list-group-item"><strong>Fecha de registro:</strong> {{ $users->created_at }}</li>
                        <li class="list-group-item"><strong>Población:</strong> {{ $users->population }}</li>
                        <li class="list-group-item"><strong>Código postal:</strong> {{ $users->postal_code }}</li>
                        <li class="list-group-item"><strong>Fecha de nacimiento:</strong> {{ $users->birthdate }}</li>
                    </ul>
                </div>
            </div>

            <h4 class="mb-3">Motos de {{ $users->name }}</h4>
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle shadow-sm">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Imagen</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Matrícula</th>
                            <th>Color</th>
                            <th>Operaciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bikes as $bike)
                        <tr>
                            <td>{{ $bike->id }}</td>
                            <td class="text-center" style="max-width: 80px">
                                <img class="rounded" style="max-width: 80%"
                                    alt="Imagen de {{ $bike->marca }} {{ $bike->modelo }}"
                                    title="Imagen de {{ $bike->marca }} {{ $bike->modelo }}"
                                    src="{{ $bike->imagen
                        ? asset('storage/' . config('filesystems.bikesImageDir') . '/' . $bike->imagen)
                        : asset('images/bikes/default.jpg') }}">
                            </td>
                            <td>{{ $bike->marca }}</td>
                            <td>{{ $bike->modelo }}</td>
                            <td>{{ $bike->matricula }}</td>
                            <td style="background-color:{{ $bike->color }}"></td>
                            <td class="text-center">
                                <div class="btn-group" role="group" aria-label="Operaciones">
                                    <a href="{{ route('bikes.show', $bike->id) }}" class="btn btn-outline-dark btn-sm">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    @auth
                                    @if(Auth::user()->can('update', $bike))
                                    <a href="{{ route('bikes.edit', $bike->id) }}" class="btn btn-outline-primary btn-sm">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    @endif
                                    @if(Auth::user()->can('delete', $bike))
                                    <a href="{{ route('bikes.delete', $bike->id) }}" class="btn btn-outline-danger btn-sm">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                    @endif
                                    @endauth
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if(count($deleteBikes))
            <h4 class="mt-5">Motos borradas</h4>
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle shadow-sm">
                    <thead class="table-secondary">
                        <tr>
                            <th>ID</th>
                            <th>Imagen</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Matrícula</th>
                            <th>Restaurar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($deleteBikes as $bike)
                        <tr>
                            <td><strong>#{{ $bike->id }}</strong></td>
                            <td class="text-center" style="max-width: 80px">
                                <img class="rounded" style="max-width: 80%"
                                    alt="Imagen de {{ $bike->marca }} {{ $bike->modelo }}"
                                    title="Imagen de {{ $bike->marca }} {{ $bike->modelo }}"
                                    src="{{ $bike->imagen
                        ? asset('storage/' . config('filesystems.bikesImageDir') . '/' . $bike->imagen)
                        : asset('images/bikes/default.jpg') }}">
                            </td>
                            <td>{{ $bike->marca }}</td>
                            <td>{{ $bike->modelo }}</td>
                            <td>{{ $bike->matricula }}</td>
                            <td class="text-center">
                                <form method="POST" action="{{ route('bikes.restore', $bike->id) }}">
                                    @csrf
                                    <button class="btn btn-outline-success btn-sm">
                                        <i class="bi bi-arrow-counterclockwise"></i> Restaurar
                                    </button>
                                </form>
                            </td>
                            <td class="text-center">
                                <form method="POST" action="{{ route('bikes.purge') }}" onsubmit="return confirm('¿Estás seguro de que quieres borrar esta moto?');">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="bike_id" value="{{ $bike->id }}">
                                    <button class="btn btn-outline-danger btn-sm">
                                        <i class="bi bi-x-circle"></i> Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection