<!-- resources/views/layout.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <nav class="navbar">
        <ul class="navbar-list">
            <li class="navbar-item"><a href="{{ route('archivos.index') }}">Inicio</a></li>
            <li class="navbar-item"><a href="{{ route('archivos.create') }}">Subir Imagen</a></li>
            <li class="navbar-item"><a href="{{ route('archivos.table') }}">Ver Tabla</a></li>
        </ul>
    </nav>
    <div class="content">
        @yield('content')
    </div>
    @yield('scripts')
</body>
</html>