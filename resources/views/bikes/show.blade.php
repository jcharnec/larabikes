        @extends('layouts.master')

        @section('titulo', "Mostrar Moto: $bike->marca $bike->modelo")

        @section('contenido')
        <table class="table table-striped table-bordered">
            <tr>
                <td>ID</td>
                <td>{{$bike->id}}</td>
            </tr>
            <tr>
                <td>Marca</td>
                <td>{{$bike->marca}}</td>
            </tr>
            <tr>
                <td>Modelo</td>
                <td>{{$bike->modelo}}</td>
            </tr>
            <tr>
                <td>Propietario</td>
                <td>{{$bike->user? $bike->user->name : 'Sin propietario'}}</td>
            </tr>
            <tr>
                <td>Precio</td>
                <td>{{$bike->precio}}</td>
            </tr>
            <tr>
                <td>Kms</td>
                <td>{{$bike->kms}}</td>
            </tr>
            <tr>
                <td>Matriculada</td>
                <td>{{$bike->matriculada? 'SI':'NO'}}</td>
            </tr>
            @if($bike->matriculada)
            <tr>
                <td>Matricula</td>
                <td>{{$bike->matricula}}</td>
            </tr>
            @endif

            @if($bike->color)
            <tr>
                <td>Color</td>
                <td style="background-color:{{$bike->color}}">{{$bike->color}}</td>
            </tr>
            @endif
            <tr>
                <td>Imagen</td>
                <td class="text-start">
                    <img class="rounded" style="max-width:400px"
                        alt="Imagen de {{$bike->marca}} {{$bike->modelo}}"
                        title="Imagen de {{$bike->marca}} {{$bike->modelo}}"
                        src="{{
    $bike->imagen
        ? asset('storage/' . config('filesystems.bikesImageDir') . '/' . $bike->imagen)
        : asset('images/bikes/default.jpg')
}}">
                </td>
            </tr>
        </table>
        <div class="text-end my-3">
            <div class="btn-group mx-2">
                <a class="mx-2" href="{{route('bikes.edit', $bike->id)}}">
                    <img height="40" width="40" alt="Modificar" title="Modificar" src="{{ asset('images/buttons/edit.svg') }}">
                </a>
                <a class="mx-2" href="{{route('bikes.delete', $bike->id)}}">
                    <img height="40" width="40" alt="Borrar" title="Borrar" src="{{ asset('images/buttons/delete.svg') }}">
                </a>

            </div>
        </div>
        @endsection

        @section('enlaces')
        @parent
        <a href="{{route('bikes.index')}}" class="btn btn-primary m-2">Garaje</a>
        @endsection