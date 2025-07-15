<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>401 Unauthorized</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">
    <div class="container d-flex flex-column justify-content-center align-items-center vh-100">
        <div class="text-center bg-white p-5 rounded shadow">
            <h1 class="display-4 text-danger">401</h1>
            <h2 class="mb-3">No autorizado</h2>
            <p class="text-muted">No puedes borrar una moto que no es tuya.</p>
            <a href="{{ url()->previous() }}" class="btn btn-outline-dark mt-3">Volver atrás</a>
        </div>
    </div>
</body>

</html>