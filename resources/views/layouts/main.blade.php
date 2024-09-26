<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/general.css')}}">
    @yield('styles')
    @livewireStyles

    <!-- SCRIPTS -->
    <script src="https://unpkg.com/darkmode-js/lib/darkmode-js.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <!-- CSRF Token -->
    <title>{{ config('app.name', 'Laravel') }}</title>
    
</head>

<body>
    {{-------------------------------}}
    <header>

    </header>
    {{-------------------------------}}
    <main>
        @yield('content')
    </main>
    {{-------------------------------}}
    <footer>
    
    </footer>
    {{-------------------------------}}

    <!-- Scripts -->
    <script>
        const options = {
            time: '0s',   // Tiempo de transición
            mixColor: '#fff', // Color de mezcla durante la transición
            saveInCookies: true, // Guardar la preferencia del usuario en cookies
            label: '🌓', // Etiqueta del botón de alternancia
            autoMatchOsTheme: true,  // Ajustar automáticamente según el tema del SO
        };
        const darkmode = new Darkmode(options);
        darkmode.showWidget(); // Mostrar el botón flotante para alternar
    </script>

    @livewireScripts
    @stack('scripts')
</body>

</html>
