@extends('layouts.master')

@section('contenido')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (Auth::user()->email_verified_at === null)
            <div class="alert alert-warning" role="alert">
                {{ __('Antes de continuar, por favor, confirme su correo electrónico que le fue enviado. Si no ha recibido el correo electrónico, haga clic aquí para solicitar otro.') }}
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('Reenviar correo de verificación') }}</button>.
                </form>
            </div>
            @endif
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
                        <p>Poblacion: {{ $users->population }}</p>
                        <p>Codigo postal: {{ $users->postal_code }}</p>
                        <p>Fecha de nacimiento: {{ $users->birthdate }}</p>
                    </div>
                </div>
            </div>
            <h3>Motos de {{ $users->name }}</h3>
            <table class="table table-striped table-bordered">
                <tr>
                    <th>ID</th>
                    <th>Imagen</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Matricula</th>
                    <th>Color</th>
                    <th>Operaciones</th>
                </tr>
                @foreach($bikes as $bike)
                <tr>
                    <td>{{$bike->id}}</td>
                    <td class="text-center" style="max-width: 80px">
                        <img class="rounded" style="max-width: 80%" alt="Imagen de {{$bike->marca}} {{$bike->modelo}}" title="Imagen de {{$bike->marca}} {{$bike->modelo}}" src="{{
                        $bike->imagen?
                        asset('storage/'.config('filesystems.bikesImageDir')).'/'.$bike->imagen:
                        asset('storage/'.config('filesystems.bikesImageDir')).'/default.jpg'}}">
                    </td>
                    <td>{{$bike->marca}}</td>
                    <td>{{$bike->modelo}}</td>
                    <td>{{$bike->matricula}}</td>
                    <td style="background-color:{{$bike->color}}"></td>
                    <td class="text-center">
                        <a href="{{route('bikes.show', $bike->id)}}">
                            <img height="20" width="20" alt="Ver detalles" title="Ver detalles" src="{{asset('images/buttons/show.svg')}}"></a>

                        @auth
                        <a href="{{route('bikes.edit', $bike->id)}}">
                            <img height="20" width="20" alt="Modificar" title="Modificar" src="{{asset('images/buttons/edit.svg')}}"></a>
                        <a href="{{route('bikes.delete', $bike->id)}}">
                            <img height="20" width="20" alt="Borrar" title="Borrar" src="{{asset('images/buttons/delete.svg')}}"></a>
                        @endauth
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="4">Mostrando {{sizeof($bikes)}} de {{$bikes->total()}}.</td>
                </tr>
            </table>
            @if(count($deleteBikes))
            <h3 class="mt-4">Motos borradas</h3>
            <table class="table table-striped table-bordered">
                <tr>
                    <th>ID</th>
                    <th>Imagen</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <td>Matricula</td>
                    <th></th>
                    <th></th>
                </tr>
                @foreach($deleteBikes as $bike)
                <tr>
                    <td><b>#{{$bike->id}}</b></td>
                    <td class="text-center" style="max-width: 80px">
                        <img class="rounded" style="max-width: 80%" 
                        alt="Imagen de {{$bike->marca}} {{$bike->modelo}}" 
                        title="Imagen de {{$bike->marca}} {{$bike->modelo}}" 
                        src="{{$bike->imagen?
                            asset('storage/'.config('filesystems.bikesImageDir')).'/'.$bike->imagen:
                            asset('storage/'.config('filesystems.bikesImageDir')).'/default.jpg'}}">
                    </td>
                    <td>{{$bike->marca}}</td>
                    <td>{{$bike->modelo}}</td>
                    <td>{{$bike->matricula}}</td>
                    <td class="text-center">
                        <form method="POST" action="{{ route('bikes.restore', $bike->id) }}">
                            @csrf
                            <button class="btn btn-success">Restaurar</button>
                        </form>
                    </td>
                    <td class="text-center">
                        <a onclick='
                            if(confirm("¿Estás seguro de que quieres borrar esta moto?"))
                                this.nextElementSibling.submit();'>
                            <button class="btn btn-danger">Eliminar</button>
                        </a>
                        <form method="POST" class="d-none" action="{{ route('bikes.purge') }}">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                            <input name="bike_id" type="hidden" value="{{ $bike->id }}">
                        </form>
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="4">Mostrando {{sizeof($bikes)}} de {{$bikes->total()}}.</td>
                </tr>
            </table>
            @endif
        </div>
    </div>
</div>
@endsection