<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Ejemplo CRUD con laravel- Larabikes">
    <title>{{config('app.name')}} - @yield('titulo')</title>

    <!-- CSS para Bootstrap -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
</head>

<body class="container p-3">

    <!-- PARTE SUPERIOR -->
    @section('navegacion')
    @php($pagina = $pagina ?? '')

    <nav>
        <ul class="nav nav-pills my-3">
            <li class="nav-item mr-2">
                <a class="nav-link {{$pagina =='portada'? 'active' : ''}}" 
                    href="{{url('/')}}">Inicio</a>
            </li>
            <li class="nav-item mr-2">
                <a class="nav-link {{$pagina =='listamotos'? 'active':''}}"
                    href="{{route('bikes.index')}}">Garaje</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{$pagina =='nuevamoto'? 'active':''}}" 
                    href="{{route('bikes.create')}}">Nueva moto</a>
            </li>
        </ul>
    </nav>
    @show

    <!-- PARTE CENTRAL -->
    <h1 class="my-2">Primer ejempo de CRUD con Laravel</h1>

    <main>
        <h2>@yield('titulo')</h2>

        @if(Session::has('success'))
        <x-alert type="success" message="{{ Session::get('success') }}"/>
        @endif

        @if($errors->any())
        <x-alert type="danger" message="Se han producido errores:">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </x-alert>
        @endif
        
        <!-- Probando el nuevo componente -->
        <x-alert type="success" message="Pasando información al componente">
            <p>Hay otro mensaje:</p>
        </x-alert>
        
        <p>Contamos con un catálogo de {{$total}} motos.</p>

        @yield('contenido')
        <div class="d-flex justify-content-center">
            <div class="btn-group" role="group" aria-label="links">
                @section('enlaces')
                <a href="{{ url('/') }}" class="btn btn-primary m-2">Inicio</a>
                @show
            </div>
        </div>
        <!-- PARTE INFERIOR -->
        @section('pie')
        <footer class="page-footer font-small p-4 bg-light">
            <p>Aplicación creada por {{$autor}} como ejemplo de Laravel.
                Desarrollado haciendo uso de <b>Laravel</b> y <b>Bootstrap</b>.</p>
        </footer>
        @show
        </div>
    </main>
</body>

</html>