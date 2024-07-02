    @extends('layouts.master')
    @php($pagina='nuevamoto')

    @section('titulo', 'Nueva Moto')

    @section('contenido')
    <form class="my-2 border p-5" method="POST" action="{{route('bikes.store')}}"
    enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group row">
            <label for="inputMarca" class="col-sm-2 col-form-label">Marca</label>
            <input name="marca" type="text" class="up form-control col-sm-10"
            id="inputMarca" placeholder="Marca" maxlength="255" value="{{old('marca')}}">
        </div>
        <div class="form-group row">
            <label for="inputModelo" class="col-sm-2 col-form-label">Modelo</label>
            <input name="modelo" type="text" class="up form-control col-sm-10" 
            id="inputModelo" placeholder="Modelo" maxlength="255" value="{{old('modelo')}}">
        </div>
        <div class="form-group row">
            <label for="inputKms" class="col-sm-2 col-form-label">Kms</label>
            <input name="kms" type="number" class="form-control col-sm-4" id="inputKms" value="{{old('kms')}}">
        </div>
        <div class="form-group row">
            <label for="inputPrecio" class="col-sm-2 col-form-label">Precio</label>
            <input name="precio" type="number" class="up form-control col-sm-4" id="inputPrecio" maxlength="11" min="0" step="0.01" value="{{old('precio')}}">
        </div>
        <div class="form-group row">
            <div class="form-check">
                <input name="matriculada" value="1" class="form-check-input" type="checkbox" {{empty(old('matriculada'))? "" : "cheked"}}>
                <label class="form-check-label">Matriculada</label>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputImagen" class="col-sm-2 col-form-label">Imagen</label>
            <input name="imagen" type="file" class="form-control col-sm-10"
            id="inputImagen" accept="image/*">
        </div>
        <div class="d-flex justify-content-center">
            <div class="form-group row">
                <button type="submit" class="btn btn-success m-2 mt-5">Guardar</button>
                <button type="reset" class="btn btn-secondary m-2">Borrar</button>
            </div>
        </div>
    </form>
    @endsection

    @section('enlaces')
    @parent
    <a href="{{route('bikes.index')}}" class="btn btn-primary m-2">Garaje</a>
    @endsection