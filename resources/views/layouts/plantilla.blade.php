<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel de Administración')</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://unpkg.com/darkmode-js/lib/darkmode-js.min.js"></script>
    <link rel="stylesheet" href="{{asset('css/categorias.css')}}">
    @yield('styles')
</head>
<body>
    <div class="categoria">
        <div class="categoria-div">

            <!-- Sidebar -->
            <div class="categoria-div-sidebar">
                <div class="categoria-div-sidebar-div">
                    <h4 style="margin-bottom: 2rem">Panel</h4>
                    <div class="categoria-div-sidebar-div-int">
                        <a class="categoria-div-sidebar-div-int-a" href="{{ url('home') }}">Ir al Home</a>
                        <a class="categoria-div-sidebar-div-int-a {{ (request()->is('categorias') || request()->is('categorias/*')) ? 'side-bar-a-activo' : '' }}" href="{{ route('categorias.index') }}">Categorías</a>
                        <a class="categoria-div-sidebar-div-int-a {{ (request()->is('plantillas') || request()->is('plantillas/*')) ? 'side-bar-a-activo' : '' }}" href="{{ route('plantillas.index') }}">Plantillas</a>
                    </div>
                </div>
            </div>

            <!-- Contenido Principal -->
            <div class="categoria-div-contenido">
                <div class="categoria-div-contenido-div">
                    @yield('content')
                </div>
            </div>
        </div>
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

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>

    @stack('scripts')
</body>
</html>
