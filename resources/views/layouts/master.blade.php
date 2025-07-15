<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Ejemplo CRUD con laravel - Larabikes">
    <title>{{ config('app.name') }} - @yield('titulo')</title>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <script src="{{ asset('js/bootstrap.bundle.js') }}"></script>
</head>

<body class="d-flex flex-column min-vh-100 bg-light">

    <!-- NAVBAR -->
    @section('navegacion')
    @php($pagina = Route::currentRouteName())
    <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ url('/') }}">
                {{ config('app.name', 'LaraBikes') }}
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- LEFT LINKS -->
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link {{ $pagina == 'portada' ? 'active' : '' }}" href="{{ route('welcome') }}">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $pagina == 'bikes.index' || $pagina == 'bikes.search' ? 'active' : '' }}" href="{{ route('bikes.index') }}">Garaje</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $pagina == 'contacto' ? 'active' : '' }}" href="{{ route('contacto') }}">Contacto</a>
                    </li>

                    @guest
                    <li class="nav-item">
                        <a class="nav-link {{ $pagina == 'register' ? 'active' : '' }}" href="{{ route('register') }}">Registro</a>
                    </li>
                    @endguest

                    @auth
                    <li class="nav-item">
                        <a class="nav-link {{ $pagina == 'home' ? 'active' : '' }}" href="{{ route('home') }}">Mis motos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $pagina == 'bikes.create' ? 'active' : '' }}" href="{{ action([App\Http\Controllers\BikeController::class, 'create']) }}">Nueva moto</a>
                    </li>
                    @if(Auth::user()->hasRole('administrador'))
                    <li class="nav-item">
                        <a class="nav-link {{ $pagina == 'admin.deleted.bikes' ? 'active' : '' }}" href="{{ route('admin.deleted.bikes') }}">Motos borradas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $pagina == 'admin.users' || $pagina == 'admin.users.search' ? 'active' : '' }}" href="{{ route('admin.users') }}">Gestión de usuarios</a>
                    </li>
                    @endif
                    @endauth
                </ul>

                <!-- RIGHT LINKS -->
                <ul class="navbar-nav ms-auto mb-2 mb-md-0">
                    @guest
                    @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @endif

                    @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                    @endif
                    @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            {{ Auth::user()->name }} ({{ Auth::user()->email }})
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                            </li>
                        </ul>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    @show

    <!-- MAIN CONTENT -->
    <main class="flex-fill container py-4">
        @hasSection('titulo')
        <h2 class="text-center mb-4">@yield('titulo')</h2>
        @endif

        @if(Session::has('success'))
        <x-alert type="success" message="{{ Session::get('success') }}" />
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

        @if(isset($total))
        <p class="text-center text-muted">Contamos con un catálogo de {{ $total }} motos.</p>
        @endif

        @yield('contenido')

        <div class="d-flex justify-content-center my-4">
            <div class="btn-group">
                @section('enlaces')
                <a href="{{ url()->previous() }}" class="btn btn-outline-dark m-2">Atrás</a>
                <a href="{{ route('welcome') }}" class="btn btn-outline-dark m-2">Inicio</a>
                @show
            </div>
        </div>
    </main>

    <!-- FOOTER -->
    @section('pie')
    <footer class="bg-dark text-white mt-auto py-3">
        <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center">
            <div class="mb-2 mb-md-0">
                Aplicación creada por <strong>{{ $autor }}</strong> como ejemplo de Laravel.<br>
                Desarrollado con <i class="bi bi-laravel"></i> Laravel y <i class="bi bi-bootstrap"></i> Bootstrap.
            </div>
            <div>
                <a href="https://github.com/jcharnec" target="_blank" class="text-white me-3">
                    <i class="bi bi-github" style="font-size: 1.5rem;"></i>
                </a>
                <a href="https://www.linkedin.com/in/hotadev/" target="_blank" class="text-white">
                    <i class="bi bi-linkedin" style="font-size: 1.5rem;"></i>
                </a>
            </div>
        </div>
    </footer>
    @show

</body>

</html>