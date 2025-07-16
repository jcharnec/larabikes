@extends('layouts.master')
@section('titulo', "Detalles del usuario $user->name")

@section('contenido')
<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow-sm mb-4">
                <div class="card-header fw-bold bg-dark text-white">
                    <i class="bi bi-person-fill"></i> Información del usuario
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-md-8">
                            <table class="table table-hover table-striped align-middle mb-0">
                                <tbody>
                                    <tr>
                                        <th scope="row">ID</th>
                                        <td>{{ $user->id }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Nombre</th>
                                        <td>{{ $user->name }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Correo</th>
                                        <td>
                                            <a href="mailto:{{ $user->email }}" class="text-decoration-none">
                                                {{ $user->email }}
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Fecha de creación</th>
                                        <td>{{ $user->created_at }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Fecha de verificación</th>
                                        <td>{{ $user->email_verified_at ?? 'Sin verificar' }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Roles</th>
                                        <td>
                                            @forelse ($user->roles as $rol)
                                            <div class="d-flex align-items-center mb-2">
                                                <span class="badge bg-secondary me-2">{{ $rol->role }}</span>
                                                <form method="POST" action="{{ route('admin.user.removeRole') }}" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                    <input type="hidden" name="role_id" value="{{ $rol->id }}">
                                                    <button type="submit" class="btn btn-outline-danger btn-sm">
                                                        <i class="bi bi-x"></i> Eliminar
                                                    </button>
                                                </form>
                                            </div>
                                            @empty
                                            <span class="text-muted">Sin roles asignados.</span>
                                            @endforelse
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Añadir rol</th>
                                        <td>
                                            <form method="POST" action="{{ route('admin.user.setRole') }}" class="d-flex flex-wrap align-items-center">
                                                @csrf
                                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                <select class="form-select me-2 mb-2" name="role_id" style="max-width: 200px;">
                                                    @foreach ($user->remainingRoles() as $rol)
                                                    <option value="{{ $rol->id }}">{{ $rol->role }}</option>
                                                    @endforeach
                                                </select>
                                                <button type="submit" class="btn btn-outline-success mb-2">
                                                    <i class="bi bi-plus-circle"></i> Añadir
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-4 text-center mt-3 mt-md-0">
                            <img src="https://www.gravatar.com/avatar/?d=mp&s=300" class="img-thumbnail rounded shadow-sm mb-2" alt="Imagen de usuario {{ $user->name }}">

                            <figcaption class="figure-caption">{{ $user->name }}</figcaption>
                        </div>
                    </div>
                </div>
            </div>

            <a href="{{ route('admin.users') }}" class="btn btn-outline-dark">
                <i class="bi bi-arrow-left"></i> Volver a lista de usuarios
            </a>
        </div>
    </div>
</div>
@endsection