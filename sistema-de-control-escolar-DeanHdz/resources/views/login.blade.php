<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Iniciar sesión</title>
        @include('partials.bootstrap')
    </head>

    <body class="">
        <header class="">
                        
        </header>

        <main class="mt-6">
                        
            <div class="p-6">
                <h1 class="">Inicio de sesión</h1>

                <form method="POST" action="{{ route('login.post') }}" class="mt-6">
                @csrf

                <div>
                <label for="email" class="">Correo</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    required
                    autofocus
                    class=""
                />
                </div>

                <div class="mt-4">
                    <label for="password" class="">Contraseña</label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        class=""
                    />
                </div>

                <div class="mt-6">
                    <button
                        type="submit"
                        class=""
                    >
                    Iniciar sesión
                    </button>
                </div>
                </form>
                          
            </div>
        </main>

        <footer class="bg-success text-white">
            Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
        </footer>
    </body>

</html>
