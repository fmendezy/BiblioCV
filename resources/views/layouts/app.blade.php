<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BiblioCV</title>
    <link rel="stylesheet" href="{{ asset('resources/css/app.css') }}">
</head>

<body>
    <div class="container">
        <nav>
            <!-- barra de navegación -->
            <a href="{{ route('users.index') }}">Usuarios</a>
            <a href="{{ route('curriculums.index') }}">Currículums</a>
        </nav>
        
        <div class="content">
            @yield('content')
        </div>
    </div>
</body>
</html>
