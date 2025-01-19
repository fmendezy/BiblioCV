<!-- Esta vista muestra los detalles de un currículum específico -->
@extends('layouts.app')

@section('content')
<h1>Detalle del Currículum</h1>

<p><strong>Nombre completo:</strong> {{ $curriculum->name }}</p>
<p><strong>RUT:</strong> {{ $curriculum->rut }}</p>
<p><strong>Fecha de nacimiento:</strong> {{ \Carbon\Carbon::parse($curriculum->dob)->format('d/m/Y') }}</p>
<p><strong>Dirección:</strong> {{ $curriculum->address }}</p>
<p><strong>Teléfono:</strong> {{ $curriculum->phone }}</p>
<p><strong>Correo electrónico:</strong> {{ $curriculum->email }}</p>
<p><strong>Estado civil:</strong> {{ $curriculum->civil_status }}</p>
<p><strong>Foto:</strong> @if($curriculum->photo) <img src="{{ $curriculum->photo }}" alt="Foto de perfil" style="width: 100px; height: 100px;"> @else No disponible @endif</p>
<p><strong>Título profesional:</strong> {{ $curriculum->degree }}</p>
<p><strong>Institución de educación:</strong> {{ $curriculum->institution }}</p>
<p><strong>Fecha de inicio en estudios:</strong> {{ \Carbon\Carbon::parse($curriculum->start_date)->format('d/m/Y') }}</p>
<p><strong>Fecha de término en estudios:</strong> @if($curriculum->end_date) {{ \Carbon\Carbon::parse($curriculum->end_date)->format('d/m/Y') }} @else No disponible @endif</p>
<p><strong>Cursos adicionales:</strong> {{ $curriculum->courses ?? 'No aplicable' }}</p>
<p><strong>Nombre de la empresa:</strong> {{ $curriculum->company }}</p>
<p><strong>Cargo ocupado:</strong> {{ $curriculum->position }}</p>
<p><strong>Fecha de inicio en el trabajo:</strong> {{ \Carbon\Carbon::parse($curriculum->job_start_date)->format('d/m/Y') }}</p>
<p><strong>Fecha de término en el trabajo:</strong> @if($curriculum->job_end_date) {{ \Carbon\Carbon::parse($curriculum->job_end_date)->format('d/m/Y') }} @else No disponible @endif</p>
<p><strong>Descripción de las funciones:</strong> {{ $curriculum->job_description }}</p>
<p><strong>Referencias laborales:</strong> {{ $curriculum->references ?? 'No aplicable' }}</p>
<p><strong>Habilidades:</strong> {{ $curriculum->skills ?? 'No aplicable' }}</p>
<p><strong>Idiomas:</strong> {{ $curriculum->languages ?? 'No aplicable' }}</p>
<p><strong>Expectativa de sueldo:</strong> {{ $curriculum->salary_expectation ? '$' . number_format($curriculum->salary_expectation, 2) : 'No disponible' }}</p>
<p><strong>Disponibilidad inmediata:</strong> {{ $curriculum->available ? 'Sí' : 'No' }}</p>
<p><strong>Referencias personales:</strong> {{ $curriculum->personal_references ?? 'No aplicable' }}</p>

<!-- Opciones de acción -->
<a href="{{ route('curriculums.edit', $curriculum->id) }}">Editar</a>

<form action="{{ route('curriculums.destroy', $curriculum->id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" onclick="return confirm('¿Estás seguro de que deseas eliminar este currículum?');">Eliminar</button>
</form>

@endsection
