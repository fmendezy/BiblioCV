<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>CV - {{ $curriculum->name }}</title>
    <style>
        @page {
            margin: 1cm;
        }
        body {
            font-family: 'Helvetica', sans-serif;
            line-height: 1.4;
            color: #333;
            margin: 0;
            padding: 15px;
            font-size: 10px;
        }
        .header {
            text-align: left;
            margin-bottom: 15px;
            position: relative;
            border-bottom: 2px solid #2563eb;
            padding-bottom: 10px;
            min-height: 80px;
        }
        .header-content {
            display: inline-block;
            width: calc(100% - 90px);
        }
        .photo {
            position: absolute;
            top: 0;
            right: 0;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
        }
        h1 {
            color: #1e40af;
            font-size: 20px;
            margin: 0 0 3px 0;
            text-transform: uppercase;
        }
        .job-title {
            color: #4b5563;
            font-size: 14px;
            margin: 0 0 5px 0;
            font-weight: 500;
        }
        .contact-info {
            color: #4b5563;
            font-size: 10px;
            margin-bottom: 5px;
        }
        .section {
            margin-bottom: 12px;
        }
        .section-title {
            color: #1e40af;
            font-size: 12px;
            margin: 0 0 8px 0;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 3px;
            text-transform: uppercase;
            font-weight: bold;
        }
        .entry {
            margin-bottom: 8px;
        }
        .entry-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2px;
        }
        .entry-title {
            font-weight: bold;
            color: #1f2937;
            font-size: 11px;
        }
        .entry-date {
            color: #6b7280;
            font-size: 10px;
        }
        .entry-subtitle {
            color: #4b5563;
            font-style: italic;
            margin-bottom: 2px;
            font-size: 10px;
        }
        .entry-description {
            color: #4b5563;
            font-size: 10px;
            margin-top: 2px;
            text-align: justify;
        }
        .skills-list {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin: 0;
            padding: 0;
            list-style: none;
        }
        .skill-item {
            background-color: #f3f4f6;
            padding: 3px 6px;
            border-radius: 3px;
            font-size: 10px;
            border: 1px solid #e5e7eb;
        }
        p {
            margin: 0 0 8px 0;
            text-align: justify;
        }
        .references-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-content">
            <h1>{{ $curriculum->name }}</h1>
            @if($curriculum->job_title)
                <div class="job-title">{{ $curriculum->job_title }}</div>
            @endif
            <div class="contact-info">
                {{ $curriculum->email }} | {{ $curriculum->phone }} | {{ $curriculum->rut }}
            </div>
        </div>
        @if($curriculum->photo)
            <img src="{{ storage_path('app/public/' . $curriculum->photo) }}" class="photo">
        @endif
    </div>

    @if($curriculum->profile_summary)
    <div class="section">
        <h2 class="section-title">Perfil Profesional</h2>
        <p>{{ $curriculum->profile_summary }}</p>
    </div>
    @endif

    @if($curriculum->educations->count() > 0)
    <div class="section">
        <h2 class="section-title">Formación Académica</h2>
        @foreach($curriculum->educations as $education)
        <div class="entry">
            <div class="entry-header">
                <span class="entry-title">{{ $education->institution }}</span>
                <span class="entry-date">
                    {{ \Carbon\Carbon::parse($education->start_date)->format('M Y') }} - 
                    {{ \Carbon\Carbon::parse($education->end_date)->format('M Y') }}
                </span>
            </div>
            <div class="entry-subtitle">{{ $education->degree }}</div>
        </div>
        @endforeach
    </div>
    @endif

    @if($curriculum->experiences->count() > 0)
    <div class="section">
        <h2 class="section-title">Experiencia Laboral</h2>
        @foreach($curriculum->experiences as $experience)
        <div class="entry">
            <div class="entry-header">
                <span class="entry-title">{{ $experience->company }}</span>
                <span class="entry-date">
                    {{ \Carbon\Carbon::parse($experience->start_date)->format('M Y') }} - 
                    {{ \Carbon\Carbon::parse($experience->end_date)->format('M Y') }}
                </span>
            </div>
            <div class="entry-subtitle">{{ $experience->position }}</div>
            @if($experience->description)
                <div class="entry-description">{{ $experience->description }}</div>
            @endif
        </div>
        @endforeach
    </div>
    @endif

    @if($curriculum->skills->count() > 0)
    <div class="section">
        <h2 class="section-title">Habilidades</h2>
        <ul class="skills-list">
            @foreach($curriculum->skills as $skill)
                <li class="skill-item">{{ $skill->name }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if($curriculum->references->count() > 0)
    <div class="section">
        <h2 class="section-title">Referencias</h2>
        <div class="references-grid">
            @foreach($curriculum->references as $reference)
            <div class="entry">
                <div class="entry-title">{{ $reference->name }}</div>
                <div class="entry-subtitle">{{ $reference->relation }}</div>
                <div class="entry-description">{{ $reference->contact }}</div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    @if($curriculum->summary)
    <div class="section">
        <h2 class="section-title">Información Adicional</h2>
        <p>{{ $curriculum->summary }}</p>
    </div>
    @endif
</body>
</html> 