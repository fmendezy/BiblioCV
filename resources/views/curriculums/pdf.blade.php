<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Currículum - {{ $curriculum->name }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .profile-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            margin: 0 auto;
            display: block;
        }
        h1 {
            color: #2563eb;
            margin: 10px 0;
        }
        h2 {
            color: #1d4ed8;
            border-bottom: 2px solid #2563eb;
            padding-bottom: 5px;
            margin-top: 20px;
        }
        .contact-info {
            text-align: center;
            margin-bottom: 20px;
        }
        .section {
            margin-bottom: 25px;
        }
        .experience-item, .education-item {
            margin-bottom: 15px;
        }
        .company-name, .institution-name {
            font-weight: bold;
            color: #4b5563;
        }
        .date {
            color: #6b7280;
            font-style: italic;
        }
        .skills-list {
            list-style-type: none;
            padding: 0;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .skill-item {
            background-color: #e5e7eb;
            padding: 5px 10px;
            border-radius: 15px;
            display: inline-block;
        }
        .references {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }
        .reference-item {
            background-color: #f3f4f6;
            padding: 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="header">
        @if($curriculum->photo)
            <img src="{{ storage_path('app/public/' . $curriculum->photo) }}" class="profile-image" alt="Foto de perfil">
        @endif
        <h1>{{ $curriculum->name }}</h1>
        <div class="contact-info">
            <p>
                {{ $curriculum->email }} | {{ $curriculum->phone }}<br>
                RUT: {{ $curriculum->rut }} | {{ $curriculum->marital_status }}<br>
                Fecha de Nacimiento: {{ \Carbon\Carbon::parse($curriculum->birthdate)->format('d/m/Y') }}
            </p>
        </div>
    </div>

    @if($curriculum->profile_summary)
    <div class="section">
        <h2>Perfil Profesional</h2>
        <p>{{ $curriculum->profile_summary }}</p>
    </div>
    @endif

    @if($curriculum->experiences->count() > 0)
    <div class="section">
        <h2>Experiencia Laboral</h2>
        @foreach($curriculum->experiences as $experience)
        <div class="experience-item">
            <div class="company-name">{{ $experience->company }} - {{ $experience->position }}</div>
            <div class="date">{{ \Carbon\Carbon::parse($experience->start_date)->format('m/Y') }} - 
                {{ \Carbon\Carbon::parse($experience->end_date)->format('m/Y') }}</div>
            @if($experience->description)
            <p>{{ $experience->description }}</p>
            @endif
        </div>
        @endforeach
    </div>
    @endif

    @if($curriculum->educations->count() > 0)
    <div class="section">
        <h2>Formación Académica</h2>
        @foreach($curriculum->educations as $education)
        <div class="education-item">
            <div class="institution-name">{{ $education->institution }}</div>
            <div>{{ $education->degree }}</div>
            <div class="date">{{ \Carbon\Carbon::parse($education->start_date)->format('Y') }} - 
                {{ \Carbon\Carbon::parse($education->end_date)->format('Y') }}</div>
        </div>
        @endforeach
    </div>
    @endif

    @if($curriculum->skills->count() > 0)
    <div class="section">
        <h2>Habilidades</h2>
        <div class="skills-list">
            @foreach($curriculum->skills as $skill)
            <span class="skill-item">{{ $skill->name }}</span>
            @endforeach
        </div>
    </div>
    @endif

    @if($curriculum->references->count() > 0)
    <div class="section">
        <h2>Referencias</h2>
        <div class="references">
            @foreach($curriculum->references as $reference)
            <div class="reference-item">
                <strong>{{ $reference->name }}</strong><br>
                {{ $reference->relation }}<br>
                {{ $reference->contact }}
            </div>
            @endforeach
        </div>
    </div>
    @endif
</body>
</html> 