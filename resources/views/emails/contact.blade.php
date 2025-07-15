<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensaje recibido: {{ $mensaje->asunto }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">
    <header class="container text-center py-4 border-bottom mb-4">
        <img src="{{ asset('images/logos/logo.png') }}" alt="Logo" style="max-height: 80px;">
        <h1 class="h4 mt-2">{{ config('app.name') }}</h1>
    </header>

    <main class="container bg-white shadow-sm rounded p-4 mb-4">
        <h2 class="mb-3 text-primary">Mensaje recibido: {{ $mensaje->asunto }}</h2>
        <p class="text-muted">
            De <strong>{{ $mensaje->nombre }}</strong>
            <a href="mailto:{{ $mensaje->email }}" class="text-decoration-none">&lt;{{ $mensaje->email }}&gt;</a>
        </p>
        <hr>
        <p class="mt-3">{{ $mensaje->mensaje }}</p>
    </main>

    <footer class="container text-center py-3 border-top">
        <small class="text-muted">
            Aplicación creada por {{ $autor }} para {{ $centro }} como ejemplo de clase.
            Desarrollada con <b>Laravel</b> y <b>Bootstrap</b>.
        </small>
    </footer>
</body>

</html>