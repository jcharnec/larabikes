<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¡Felicidades por tu primera moto!</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">
    <header class="container py-4 my-3 text-center border-bottom">
        <img src="{{ asset('images/logos/logo.png') }}" alt="LaraBikes Logo" style="max-height: 80px;">
    </header>

    <main class="container bg-white shadow-sm rounded p-4 my-4">
        <div class="text-center">
            <h1 class="display-5 text-success mb-3">¡Felicidades!</h1>
            <h2 class="h4 mb-4">Has publicado tu primera moto en LaraBikes</h2>
            <p class="lead">Tu nueva moto <strong>{{ $bike->marca }} {{ $bike->modelo }}</strong> ya aparece en los resultados.</p>
            <p>¡Sigue así! Estás ayudando a que LaraBikes se convierta en la mejor red de intercambio y compra-venta de motocicletas entre usuarios de los CIFO.</p>
        </div>
    </main>

    <footer class="container text-center py-3 border-top">
        <small class="text-muted">
            Aplicación creada por {{ $autor }} como ejemplo de clase. Desarrollada con <b>Laravel</b> y <b>Bootstrap</b>.
        </small>
    </footer>
</body>

</html>