@extends('layouts.master')


@section('contenido')
<!-- Usamos el URL::signedRoute() y no route() para firmar las url y que no puedan trastear
        la ruta haciendo inyecciones, tambiénn tenemos un middleware llamado signed para hacer esto -->
<div class="container">
    <h3 class="mt-4">Motos borradas</h3>
    <div class="text-start">{{ $bikes->links() }}</div>
    <table class="table table-striped table-bordered">
        <tr>
            <th>ID</th>
            <th>Imagen</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Matrícula</th>
            <th>Usuario</th>
            <th></th>
            <th></th>
        </tr>
        @forelse($bikes as $bike)
        <tr>
            <td><b>#{{ $bike->id }}</b></td>
            <td class="text-center" style="max-width: 80px">
                <img [class="rounded" style="max-width: 80%" alt="Imagen de {{$bike->marca}} {{$bike->modelo}}" title="Imagen de {{$bike->marca}} {{$bike->modelo}}" src="{{$bike->imagen?
                                                asset('storage/'.config('filesystems.bikesImageDir')).'/'.$bike->imagen:
                                                asset('storage/'.config('filesystems.bikesImageDir')).'/default.jpg'}}">
            </td>

            <td>{{$bike->marca}}</td>
            <td>{{$bike->modelo}}</td>
            <td>{{$bike->matricula}}</td>
            <td>{{$bike->user ? $bike->user->name : 'Desconocido'}}</td>
            <td class="text-center">
                <a href="{{route('bikes.restore', $bike->id)}}">
                    <button class="btn btn-success">Restaurar</button>
                </a>
            </td>
            <td class="text-center">
                <a onclick="
                                                if(confirm('¿Estás seguro de que quieres borrarlo?'))
                                                        this.nextElementSibling.submit();">
                    <button class="btn btn-danger">Eliminar</button>
                </a>
                <form method="post" class="d-none" action="{{route('bikes.purge')}}">
                    @csrf
                    <input name="_method" type="hidden" value="DELETE">
                    <input name="bike_id" type="hidden" value="{{ $bike->id }}">
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="8" class="alert alert-danger">No hay motos borradas.</td>
        </tr>
        @endforelse
    </table>
</div>

@endsection