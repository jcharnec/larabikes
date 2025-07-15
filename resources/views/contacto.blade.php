@extends('layouts.master')
@section('titulo', 'Contactar con LaraBikes')

@section('contenido')
<div class="container my-4">
    <div class="row">
        <div class="col-lg-7 mb-4">
            <div class="border rounded shadow-sm p-4 bg-light">
                <h4 class="mb-4">Formulario de Contacto</h4>
                <form method="POST" action="{{ route('contacto.email') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3 row">
                        <label for="inputEmail" class="col-sm-3 col-form-label fw-bold">Email</label>
                        <div class="col-sm-9">
                            <input name="email" type="email" class="form-control" id="inputEmail" placeholder="Email" maxlength="255" required value="{{ old('email') }}">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="inputNombre" class="col-sm-3 col-form-label fw-bold">Nombre</label>
                        <div class="col-sm-9">
                            <input name="nombre" type="text" class="form-control" id="inputNombre" placeholder="Nombre" maxlength="255" required value="{{ old('nombre') }}">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="inputAsunto" class="col-sm-3 col-form-label fw-bold">Asunto</label>
                        <div class="col-sm-9">
                            <input name="asunto" type="text" class="form-control" id="inputAsunto" placeholder="Asunto" maxlength="255" required value="{{ old('asunto') }}">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="inputMensaje" class="col-sm-3 col-form-label fw-bold">Mensaje</label>
                        <div class="col-sm-9">
                            <textarea name="mensaje" class="form-control" id="inputMensaje" maxlength="2048" required rows="4" placeholder="Escribe tu mensaje...">{{ old('mensaje') }}</textarea>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="inputFichero" class="col-sm-3 col-form-label fw-bold">Adjunto (PDF)</label>
                        <div class="col-sm-9">
                            <input name="fichero" type="file" class="form-control" accept="application/pdf" id="inputFichero">
                        </div>
                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        <button type="submit" class="btn btn-success me-2">
                            <i class="bi bi-send-fill"></i> Enviar
                        </button>
                        <button type="reset" class="btn btn-outline-secondary">
                            <i class="bi bi-x-circle"></i> Borrar
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="ratio ratio-4x3 rounded shadow-sm overflow-hidden">
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d47756.809513288754!2d2.0175253!3d41.5735601!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ses!2ses!4v1720001205648!5m2!1ses!2ses" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
</div>
@endsection

@section('enlaces')
@parent
<a href="{{ route('bikes.index') }}" class="btn btn-outline-dark m-2">Garaje</a>
@endsection