        @extends('layouts.master')

        @section('titulo', "Actualización de la moto $bike->marca $bike->modelo")
        
        @section('contenido')
        <form class="my-2 border p-5" method="POST" action="{{route('bikes.update', $bike->id)}}">
            {{csrf_field()}}
            <input name="_method" type="hidden" value="PUT">

            <div class="form-group row">
                <label for="inputMarca" class="col-sm col-form-label">Marca</label>
                <input name="marca" value="{{old('marca', $bike->marca)}}" type="text" class="up form-control col-sm-10" id="inputMarca" placeholder="Marca" maxlength="255">
            </div>
            <div class="form-group row">
                <label for="inputModelo" class="col-sm col-form-label">Modelo</label>
                <input name="modelo" value="{{old('modelo', $bike->modelo)}}" type="text" class="up form-control col-sm-10" id="inputModelo" placeholder="Modelo" maxlength="255">
            </div>
            <div class="form-group row">
                <label for="inputPrecio" class="col-sm col-form-label">Precio</label>
                <input name="precio" value="{{old('precio', $bike->precio)}}" type="number" class="up form-control col-sm-10" id="inputPrecio" min="0" step="0.01">
            </div>
            <div class="form-group row">
                <label for="inputKms" class="col-sm-2 col-form-label">Kms</label>
                <input name="kms" value="{{old('kms', $bike->kms)}}" type="number" class="form-control col-sm-4" id="inputKms">
            </div>
            <div class="form-group row">
                <div class="form-check">
                    <input name="matriculada" value="1" class="form-check-input" type="checkbox" {{$bike->matriculada? "checked":""}}>
                    <label class="form-check-label">Matriculada</label>
                </div>
            </div>
            <div class="form-group row">
                <button type="submit" class="btn btn-success mt-5 m-2">Guardar</button>
                <button type="reset" class="btn btn-secondary m-2">Reestablecer</button>
            </div>
        </form>
        <div class="text-end my-3"></div>
        <div class="text-end my-3">
            <div class="btn-group mx-2">
                <a class="mx-2" href="{{route('bikes.show', $bike->id)}}">
                    <img height="40" width="40" alt="Detalles" title="Detalles">
                </a>
                <a class="mx-2" href="{{route('bikes.delete', $bike->id)}}">
                    <img height="40" width="40" alt="Borrar" title="Borrar">
                </a>
            </div>
        </div>
        @endsection

        @section('enlaces')
            @parent
                <a href="{{route('bikes.index')}}" class="btn btn-primary m-2">Garaje</a>
        
        @endsection