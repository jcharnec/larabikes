@extends('layouts.master')
@section('titulo', 'Lista de usuarios')

@section('contenido')
<div class="container my-4">

    <h3 class="mb-3">Lista de usuarios</h3>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.users.search') }}" class="row g-3 align-items-center">
                <div class="col-md-4">
                    <input name="name" type="text" class="form-control" placeholder="Nombre" maxlength="16" value="{{ $name ?? '' }}">
                </div>
                <div class="col-md-4">
                    <input name="email" type="text" class="form-control" placeholder="Email" maxlength="64" value="{{ $email ?? '' }}">
                </div>
                <div class="col-md-4 d-flex justify-content-start">
                    <button type="submit" class="btn btn-outline-dark me-2">
                        <i class="bi bi-search"></i> Buscar
                    </button>
                    <a href="{{ route('admin.users') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-x-circle"></i> Quitar filtro
                    </a>
                </div>
            </form>
        </div>
    </div>

    <div class="mb-3">
        {{ $users->links() }}
    </div>

    <div class="table-responsive shadow-sm rounded">
        <table class="table table-hover table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Fecha de alta</th>
                    <th>Roles</th>
                    <th>Operaciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $u)
                <tr>
                    <td class="text-center"><strong>#{{ $u->id }}</strong></td>
                    <td>
                        <a href="{{ route('admin.user.show', $u->id) }}" class="fw-bold text-decoration-none text-dark">
                            {{ $u->name }}
                        </a>
                    </td>
                    <td>
                        <a href="mailto:{{ $u->email }}" class="text-decoration-none">
                            {{ $u->email }}
                        </a>
                    </td>
                    <td>{{ $u->created_at }}</td>
                    <td class="small">
                        @foreach ($u->roles as $rol)
                        <span class="badge bg-secondary">{{ $rol->role }}</span>
                        @endforeach
                    </td>
                    <td class="text-center">
                        <a href="{{ route('admin.user.show', $u->id) }}" class="btn btn-outline-dark btn-sm" title="Ver detalles">
                            <i class="bi bi-eye"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $users->links() }}
    </div>
</div>
@endsection