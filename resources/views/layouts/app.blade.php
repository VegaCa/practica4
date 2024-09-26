<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel de Administración')</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://unpkg.com/darkmode-js/lib/darkmode-js.min.js"></script>
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
    @yield('styles')
</head>
<body>
    <div class="principal">
        @yield('content')
    </div>

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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
