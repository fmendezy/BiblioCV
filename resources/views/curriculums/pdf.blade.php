<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Curriculum de {{ $curriculum->name }}</title>
    <style>
        body {
            font-family: sans-serif;
        }
        .container {
            width: 80%;
            margin: 0 auto;
        }
        h1, h2, h3 {
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .section {
            margin-bottom: 30px;
        }
        .section-title {
            font-size: 1.3em;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .list-item {
            margin-bottom: 8px;
        }
        .list-item strong {
            font-weight: bold;
        }
        .grid-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr); /* Adjust as needed */
            gap: 20px;
        }
        .image-container {
            text-align: center; /* Center the image */
            margin-top: 20px; /* Add some space above the image */
        }
        img {
            max-width: 150px; /* Adjust the maximum width as desired */
            height: auto; /* Maintain aspect ratio */
            border-radius: 50%; /* Make the image circular */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Currículum Vitae</h1>
            @if($curriculum->profile_image)
                <div class="image-container">
                    <img src="{{ storage_path('app/public/' . $curriculum->profile_image) }}" alt="Foto de Perfil">
                </div>
            @endif
            <p><strong>Nombre:</strong> {{ $curriculum->name }}</p>
            <p><strong>RUT:</strong> {{ $curriculum->rut }}</p>
            <p><strong>Correo Electrónico:</strong> {{ $curriculum->email }}</p>
            <p><strong>Teléfono:</strong> {{ $curriculum->phone }}</p>
        </div>

        <div class="section">
            <h2 class="section-title">Resumen Profesional</h2>
            <p>{{ $curriculum->summary }}</p>
        </div>

        <div class="section">
            <h2 class="section-title">Formación Académica</h2>
            @foreach ($curriculum->education as $education)
                <div class="list-item">
                    <strong>Institución:</strong> {{ $education->institution }}<br>
                    <strong>Título:</strong> {{ $education->degree }}
                </div>
            @endforeach
        </div>

        <div class="section">
            <h2 class="section-title">Experiencia Laboral</h2>
            @foreach ($curriculum->experience as $experience)
                <div class="list-item">
                    <strong>Empresa:</strong> {{ $experience->company }}<br>
                    <strong>Puesto:</strong> {{ $experience->position }}
                </div>
            @endforeach
        </div>

        <div class="section">
            <h2 class="section-title">Habilidades</h2>
            <ul>
                @foreach ($curriculum->skills as $skill)
                    <li>{{ $skill->skill }}</li>
                @endforeach
            </ul>
        </div>

        <div class="section">
            <h2 class="section-title">Referencias Personales</h2>
            <div class="grid-container">
                @foreach ($curriculum->references as $reference)
                    <div>
                        <strong>Nombre:</strong> {{ $reference->reference_name }}<br>
                        <strong>Relación:</strong> {{ $reference->relation }}<br>
                        <strong>Contacto:</strong> {{ $reference->contact_info }}
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</body>
</html>