    @extends('layouts.master')
    @php($pagina='listamotos')

    @section('titulo', 'Listado Motos')

    @section('contenido')

    <div class="row">
        <div class="col-6 text-start">{{ $bikes->links() }}</div>
        <div class="col-6 text-end">
            <p>Nueva moto <a href="{{route('bikes.create')}}" class="btn btn-success ml-2">+</a></p>
        </div>
    </div>
    <table class="table table-striped table-bordered">
        <tr>
            <th>ID</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Operaciones</th>
        </tr>
        @foreach($bikes as $bike)
        <tr>
            <td>{{$bike->id}}</td>
            <td>{{$bike->marca}}</td>
            <td>{{$bike->modelo}}</td>
            <td class="text-center">
                <a href="{{route('bikes.show', $bike->id)}}">
                    <img height="20" width="20" alt="Ver detalles" title="Ver detalles" src="{{asset('images/buttons/show.svg')}}"></a>
                <a href="{{route('bikes.edit', $bike->id)}}">
                    <img height="20" width="20" alt="Modificar" title="Modificar" src="{{asset('images/buttons/edit.svg')}}"></a>
                <a href="{{route('bikes.delete', $bike->id)}}">
                    <img height="20" width="20" alt="Borrar" title="Borrar" src="{{asset('images/buttons/delete.svg')}}"></a>
            </td>
        </tr>
        @endforeach
        <tr>
            <td colspan="4">Mostrando {{sizeof($bikes)}} de {{$total}}.</td>
        </tr>
    </table>
    @endsection

    @section('enlaces')
    @parent
    <a href="{{route('bikes.index')}}" class="btn btn-primary m-2">Garaje</a>
    @endsection