<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <style>
        @php 
            include 'css/bootstrap.min.css';
        @endphp
    </style>
</head>

<body class="container p-3">
    <header class="container row bg-light p-4 m-4">
        <figure class="img-fluid col-2">
            <img src="{{asset('images/logos/logo.png')}}" alt="logo">
        </figure>
        <h1 class="col-10">{{config('app.name')}}</h1>
    </header>
    <main>
        <h2>Mensaje recibido: {{$mensaje->asunto}}</h2>
        <p class="cursiva">De {{$mensaje->nombre}}
            <a href="mailto:{{$mensaje->email}}">&lt;{{$mensaje->email}}&gt;</a>
        </p>
        <p>{{$mensaje->mensaje}}</p>
    </main>
    <footer class="page-footer font-smaill p-4 my-4 by-light">
        <p>Aplicación creda por {{$autor}} para {{$centro}} como ejemplo de clase.
            Desarrolada haciendo uso de <b>Laravel</b> y <b>Bootstrap</b>.
        </p>
    </footer>
</body>

</html>