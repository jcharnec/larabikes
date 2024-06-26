        @extends('layouts.master')

        @section('titulo', "Confirmación de borrado de $bike->marca $bike->modelo")

        @section('contenido')
        <!-- Usamos el URL::signedRoute() y no route() para firmar las url y que no puedan trastear
         la ruta haciendo inyecciones, tambiénn tenemos un middleware llamado signed para hacer esto -->
        <form method="post" class="my-2 border p-5" action="{{URL::temporarySignedRoute('bikes.destroy', 
                    now()->addMinutes(1),$bike->id)}}">
            {{csrf_field()}}
            <input name="_method" type="hidden" value="DELETE">
            <label for="confirmdelete">Confirmar el borrado de {{"$bike->marca $bike->modelo"}}</label>
            <input type="submit" alt="Borrar" title="Borrar" class="btn btn-danger m-4" value="Borrar" id="confirmdelete">
        </form>

        @endsection

        @section('enlaces')
        @parent
        <a href="{{route('bikes.index')}}" class="btn btn-primary m-2">Garaje</a>
        <a href="{{route('bikes.show', $bike->id)}}" class="btn btn-primary m-2">Regresar a detalles de la moto</a>
        @endsection