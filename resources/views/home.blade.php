@extends('layouts.master')

@section('contenido')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
<<<<<<< HEAD
            @if (Auth::user()->email_verified_at === null)
            <div class="alert alert-warning" role="alert">
                {{ __('Antes de continuar, por favor, confirme su correo electrónico que le fue enviado. Si no ha recibido el correo electrónico, haga clic aquí para solicitar otro.') }}
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('Reenviar correo de verificación') }}</button>.
                </form>
            </div>
            @endif
=======
>>>>>>> 4af95217f3ccd875b6e0aca51c59afc19648210b
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
<<<<<<< HEAD
                        <p>Poblacion: {{ $users->population }}</p>
                        <p>Codigo postal: {{ $users->postal_code }}</p>
                        <p>Fecha de nacimiento: {{ $users->birthdate }}</p>
                    </div>
                </div>
            </div>
            <h2>Bicicletas de {{ $users->name }}</h2>
            <table class="table table-striped table-bordered">
                <tr>
                    <th>ID</th>
                    <th>Imagen</th>
                    <th>Marca</th>
                    <th>Modelo</th>
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
        </div>
    </div>
</div>
@endsection
=======
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
>>>>>>> 4af95217f3ccd875b6e0aca51c59afc19648210b
