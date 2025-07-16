@extends('layouts.master')

@section('titulo', 'Motos borradas (Administración)')

@section('contenido')
<div class="container my-4">
    <h3 class="mb-3">Motos borradas</h3>

    <div class="mb-3">
        {{ $bikes->links() }}
    </div>

    <div class="table-responsive shadow-sm rounded">
        <table class="table table-hover table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Imagen</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Matrícula</th>
                    <th>Usuario</th>
                    <th>Restaurar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bikes as $bike)
                <tr>
                    <td><strong>#{{ $bike->id }}</strong></td>
                    <td class="text-center" style="max-width: 80px;">
                        <img class="rounded img-fluid"
                            alt="Imagen de {{ $bike->marca }} {{ $bike->modelo }}"
                            title="Imagen de {{ $bike->marca }} {{ $bike->modelo }}"
                            style="max-width: 80%"
                            src="{{ $bike->imagen
                                ? asset('storage/' . config('filesystems.bikesImageDir') . '/' . $bike->imagen)
                                : asset('storage/' . config('filesystems.bikesImageDir') . '/default.jpg') }}">
                    </td>
                    <td>{{ $bike->marca }}</td>
                    <td>{{ $bike->modelo }}</td>
                    <td>{{ $bike->matricula }}</td>
                    <td>{{ $bike->user ? $bike->user->name : 'Desconocido' }}</td>
                    <td class="text-center">
                        <a href="{{ route('bikes.restore', $bike->id) }}" class="btn btn-outline-success btn-sm">
                            <i class="bi bi-arrow-counterclockwise"></i> Restaurar
                        </a>
                    </td>
                    <td class="text-center">
                        <form method="POST" action="{{ route('bikes.purge') }}" onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta moto?');">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="bike_id" value="{{ $bike->id }}">
                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                <i class="bi bi-x-circle"></i> Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-danger fw-bold py-3">
                        No hay motos borradas.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection