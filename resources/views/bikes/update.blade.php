@extends('layouts.master')

@php($pagina='editarmoto')

@section('titulo', "Editar Moto: $bike->marca $bike->modelo")

@section('contenido')
<form class="my-4 border rounded p-4 bg-light" method="POST" action="{{ route('bikes.update', $bike->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row mb-3">
        <label for="inputMarca" class="col-sm-2 col-form-label">Marca</label>
        <div class="col-sm-10">
            <input name="marca" value="{{ old('marca', $bike->marca) }}" type="text" class="form-control" id="inputMarca" placeholder="Marca" maxlength="255" required>
        </div>
    </div>

    <div class="row mb-3">
        <label for="inputModelo" class="col-sm-2 col-form-label">Modelo</label>
        <div class="col-sm-10">
            <input name="modelo" value="{{ old('modelo', $bike->modelo) }}" type="text" class="form-control" id="inputModelo" placeholder="Modelo" maxlength="255" required>
        </div>
    </div>

    <div class="row mb-3">
        <label for="inputPrecio" class="col-sm-2 col-form-label">Precio</label>
        <div class="col-sm-4">
            <input name="precio" value="{{ old('precio', $bike->precio) }}" type="number" class="form-control" id="inputPrecio" min="0" step="0.01" required>
        </div>
        <label for="inputKms" class="col-sm-2 col-form-label">Kms</label>
        <div class="col-sm-4">
            <input name="kms" value="{{ old('kms', $bike->kms) }}" type="number" class="form-control" id="inputKms" required>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-sm-6 form-check">
            <input name="matriculada" value="1" class="form-check-input" type="checkbox" id="chkMatriculada" {{ $bike->matriculada ? "checked" : "" }}>
            <label class="form-check-label" for="chkMatriculada">Matriculada</label>
        </div>
        <div class="col-sm-6">
            <label for="inputMatricula" class="form-label">Matrícula</label>
            <input name="matricula" type="text" class="form-control" id="inputMatricula" maxlength="7" value="{{ old('matricula', $bike->matricula) }}">
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            inputMatricula.disabled = !chkMatriculada.checked;
            chkMatriculada.addEventListener('change', () => {
                inputMatricula.disabled = !chkMatriculada.checked;
            });
        });
    </script>

    <div class="row mb-3">
        <div class="col-sm-6 form-check">
            <input type="checkbox" class="form-check-input" id="chkColor" {{ $bike->color ? 'checked' : '' }}>
            <label class="form-check-label" for="chkColor">Indicar el color</label>
        </div>
        <div class="col-sm-6">
            <label for="inputColor" class="form-label">Color</label>
            <input name="color" type="color" class="form-control form-control-color" id="inputColor" value="{{ old('color', $bike->color ?? '#FFFFFF') }}">
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            inputColor.disabled = !chkColor.checked;
            chkColor.addEventListener('change', () => {
                inputColor.disabled = !chkColor.checked;
            });
        });
    </script>

    <div class="row mb-4">
        <div class="col-sm-9">
            <label for="inputImagen" class="form-label">
                {{ $bike->imagen ? 'Sustituir imagen' : 'Añadir imagen' }}
            </label>
            <input name="imagen" type="file" class="form-control" id="inputImagen" accept="image/*">

            @if($bike->imagen)
            <div class="form-check mt-3">
                <input name="eliminarimagen" type="checkbox" class="form-check-input" id="inputEliminar">
                <label class="form-check-label" for="inputEliminar">Eliminar imagen</label>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    inputEliminar.addEventListener('change', () => {
                        inputImagen.disabled = inputEliminar.checked;
                    });
                });
            </script>
            @endif
        </div>
        <div class="col-sm-3 text-center">
            <label>Imagen actual:</label>
            <img class="img-thumbnail my-2" style="max-width: 100%;" alt="Imagen de {{ $bike->marca }} {{ $bike->modelo }}"
                src="{{ $bike->imagen ? asset('storage/' . config('filesystems.bikesImageDir') . '/' . $bike->imagen) : asset('images/bikes/default.jpg') }}">
        </div>
    </div>

    <div class="text-center">
        <button type="submit" class="btn btn-success m-2"><i class="bi bi-save"></i> Guardar</button>
        <button type="reset" class="btn btn-secondary m-2"><i class="bi bi-arrow-counterclockwise"></i> Reestablecer</button>
    </div>
</form>

<div class="text-center my-3">
    <div class="btn-group">
        <a href="{{ route('bikes.show', $bike->id) }}" class="btn btn-outline-secondary btn-sm" title="Detalles">
            <i class="bi bi-eye"></i>
        </a>
        <a href="{{ route('bikes.delete', $bike->id) }}" class="btn btn-outline-danger btn-sm" title="Borrar">
            <i class="bi bi-trash"></i>
        </a>
    </div>
</div>
@endsection

@section('enlaces')
@parent
<a href="{{ route('bikes.index') }}" class="btn btn-outline-dark m-2">Garaje</a>
@endsection