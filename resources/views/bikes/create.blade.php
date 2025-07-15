@extends('layouts.master')
@php($pagina='nuevamoto')

@section('titulo', 'Nueva Moto')

@section('contenido')
<form class="my-4 p-4 border rounded shadow-sm bg-light" method="POST" action="{{route('bikes.store')}}" enctype="multipart/form-data">
    @csrf

    <div class="mb-3 row">
        <label for="inputMarca" class="col-sm-2 col-form-label fw-bold">Marca</label>
        <div class="col-sm-10">
            <input name="marca" type="text" class="form-control" id="inputMarca" placeholder="Marca" maxlength="255" value="{{ old('marca') }}">
        </div>
    </div>

    <div class="mb-3 row">
        <label for="inputModelo" class="col-sm-2 col-form-label fw-bold">Modelo</label>
        <div class="col-sm-10">
            <input name="modelo" type="text" class="form-control" id="inputModelo" placeholder="Modelo" maxlength="255" value="{{ old('modelo') }}">
        </div>
    </div>

    <div class="mb-3 row">
        <label for="inputKms" class="col-sm-2 col-form-label fw-bold">Kms</label>
        <div class="col-sm-4">
            <input name="kms" type="number" class="form-control" id="inputKms" value="{{ old('kms') }}">
        </div>
    </div>

    <div class="mb-3 row">
        <label for="inputPrecio" class="col-sm-2 col-form-label fw-bold">Precio</label>
        <div class="col-sm-4">
            <input name="precio" type="number" class="form-control" id="inputPrecio" min="0" step="0.01" value="{{ old('precio') }}">
        </div>
    </div>

    <div class="form-check mb-3">
        <input name="matriculada" value="1" class="form-check-input" type="checkbox" id="chkMatriculada" {{ empty(old('matriculada')) ? "" : "checked" }}>
        <label class="form-check-label" for="chkMatriculada">
            ¿Está matriculada?
        </label>
    </div>

    <div class="row mb-3">
        <label for="inputMatricula" class="col-sm-2 col-form-label fw-bold">Matrícula</label>
        <div class="col-sm-5">
            <input name="matricula" type="text" class="form-control" id="inputMatricula" maxlength="7" value="{{ old('matricula') }}">
        </div>
        <label for="confirmMatricula" class="col-sm-2 col-form-label fw-bold">Repetir</label>
        <div class="col-sm-3">
            <input name="matricula_confirmation" type="text" class="form-control" id="confirmMatricula" maxlength="7" value="{{ old('matricula_confirmation') }}">
        </div>
    </div>

    <div class="form-check mb-3">
        <input type="checkbox" class="form-check-input" id="chkColor">
        <label class="form-check-label" for="chkColor">¿Indicar color?</label>
    </div>

    <div class="mb-3 row">
        <label for="inputColor" class="col-sm-2 col-form-label fw-bold">Color</label>
        <div class="col-sm-4">
            <input name="color" type="color" class="form-control form-control-color" id="inputColor" value="{{ old('color') ?? '#FFFFFF' }}">
        </div>
    </div>

    <div class="mb-3 row">
        <label for="inputImagen" class="col-sm-2 col-form-label fw-bold">Imagen</label>
        <div class="col-sm-10">
            <input name="imagen" type="file" class="form-control" id="inputImagen" accept="image/*">
        </div>
    </div>

    <div class="d-flex justify-content-center mt-4">
        <button type="submit" class="btn btn-success me-2">
            <i class="bi bi-check-circle"></i> Guardar
        </button>
        <button type="reset" class="btn btn-outline-secondary">
            <i class="bi bi-x-circle"></i> Borrar
        </button>
    </div>
</form>

<script>
    const inputMatricula = document.getElementById('inputMatricula');
    const confirmMatricula = document.getElementById('confirmMatricula');
    const chkMatriculada = document.getElementById('chkMatriculada');
    const inputColor = document.getElementById('inputColor');
    const chkColor = document.getElementById('chkColor');

    const toggleMatricula = () => {
        inputMatricula.disabled = !chkMatriculada.checked;
        confirmMatricula.disabled = !chkMatriculada.checked;
    };
    const toggleColor = () => {
        inputColor.disabled = !chkColor.checked;
    };

    chkMatriculada.addEventListener('change', toggleMatricula);
    chkColor.addEventListener('change', toggleColor);

    // inicial
    toggleMatricula();
    toggleColor();
</script>
@endsection

@section('enlaces')
@parent
<a href="{{ route('bikes.index') }}" class="btn btn-outline-dark m-2">Garaje</a>
@endsection