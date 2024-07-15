    @extends('layouts.master')
    @php($pagina='listamotos')

    @section('titulo', 'Listado Motos')

    @section('contenido')
    <form method="GET" class="col-6 row"
        action="{{route('bikes.search')}}">
    
        <input type="text" name="marca" class="col form-control mr-2 mb-2" 
                placeholder="Marca" maxlength="16"
                value="{{ $marca ?? ''}}">

        <input name="modelo" type="text" class="col form-control mr-2 mb-2"
                placeholder="Modelo" maxlength="16"
                value="{{ $modelo ?? ''}}">
            
        <button type="submit" class="col btn btn-primary mr-2 mb-2">Buscar</button>
        <a href="{{ route('bikes.index') }}">
            <button type="button" class="col btn btn-secondary mr-2 mb-2">Quitar filtro</button>
        </a>

    </form>

    <div class="row">
        <div class="col-6 text-start">{{ $bikes->links() }}</div>
        <div class="col-6 text-end">
            @auth
            <p>Nueva moto <a href="{{route('bikes.create')}}" class="btn btn-success ml-2">+</a></p>
            @endauth
        </div>
    </div>
    <table class="table table-striped table-bordered">
        <tr>
            <th>ID</th>
            <th>Imagen</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Matrícula</th>
            <th>Color</th>
            <th>Operaciones</th>
        </tr>
        @foreach($bikes as $bike)
        <tr>
            <td>{{$bike->id}}</td>
            <td class="text-center" style="max-width: 80px">
                <img class="rounded" style="max-width: 80%"
                    alt="Imagen de {{$bike->marca}} {{$bike->modelo}}"
                    title="Imagen de {{$bike->marca}} {{$bike->modelo}}"
                    src="{{
                        $bike->imagen?
                        asset('storage/'.config('filesystems.bikesImageDir')).'/'.$bike->imagen:
                        asset('storage/'.config('filesystems.bikesImageDir')).'/default.jpg'}}">
            </td>
            <td>{{$bike->marca}}</td>
            <td>{{$bike->modelo}}</td>
            <td>{{$bike->matricula}}</td>
            <td style="background-color:{{ $bike->color }}">{{$bike->color}}</td>
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
    @endsection

    @section('enlaces')
    @parent
    <a href="{{route('bikes.index')}}" class="btn btn-primary m-2">Garaje</a>
    @endsection