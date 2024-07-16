<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sistema de control escolar</title>
        @include('partials.bootstrap')
    </head>
    <body class="w-100 bg-light">
        
        <header class="container-fluid p-4 text-center text-white bg-dark">
            <h1>Sistema de control escolar</h1>
            <p>Creado por: Hernandez Dean Joshua 314118</p>
        </header>

        <main class="container mt-4 text-center">
            <div class="bg-success rounded-pill p-2 border">
                <h2 class="text-white">Elegir tipo de usuario</h2>
            </div>
            <div class="row mt-4">
                <div class="col">
                    <h4>Iniciar como administrador</h4>
                    <a href="{{ route('admin') }}">
                        <button
                            class="btn btn-primary"
                        >
                        Tablero de Admin
                        </button>
                    </a>
                </div>
                <div class="col">
                    <h4>Iniciar como maestro</h4>
                    @if (Route::has('login'))
                    <nav class="">
                        @auth
                            <a href="{{ route('maestro') }}">
                            <button
                                class="btn btn-primary"
                            >
                                Tablero de maestro 
                             </button>
                            </a>
                            <p>(Sesión ya iniciada previamente)</p>
                        @else
                            <a href="{{ route('login') }}">
                            <button
                                class="btn btn-primary"
                            >
                                Iniciar sesión
                            </button>
                            </a> 
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}">
                                <button
                                    class="btn btn-primary"
                                >
                                    Registrarse
                                </button>
                                </a>
                            @endif
                        @endauth
                    </nav>
                    @endif
                </div>
            </div>
        </main>

        <footer class="text-center mt-4">
            Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
        </footer>
    </body>
</html>
