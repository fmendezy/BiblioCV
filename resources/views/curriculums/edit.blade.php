<!-- Esta vista permite editar los currículums existentes, llenará los campos con los datos actuales del currículum -->
@extends('layouts.app')

@section('content')
<h1>Editar currículum</h1>

<form action="{{ route('curriculums.update', $curriculum->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label for="name">Nombre completo:</label>
    <input type="text" name="name" id="name" value="{{ $curriculum->name }}" required>

    <label for="rut">RUT:</label>
    <input type="text" name="rut" id="rut" value="{{ $curriculum->rut }}" required>

    <label for="dob">Fecha de nacimiento:</label>
    <input type="date" name="dob" id="dob" value="{{ $curriculum->dob }}" required>

    <label for="address">Dirección:</label>
    <input type="text" name="address" id="address" value="{{ $curriculum->address }}" required>

    <label for="phone">Teléfono:</label>
    <input type="text" name="phone" id="phone" value="{{ $curriculum->phone }}" required>

    <label for="email">Correo electrónico:</label>
    <input type="email" name="email" id="email" value="{{ $curriculum->email }}" required>

    <label for="civil_status">Estado civil:</label>
    <input type="text" name="civil_status" id="civil_status" value="{{ $curriculum->civil_status }}" required>

    <label for="photo">URL Foto (opcional):</label>
    <input type="text" name="photo" id="photo" value="{{ $curriculum->photo }}">

    <label for="degree">Título profesional:</label>
    <input type="text" name="degree" id="degree" value="{{ $curriculum->degree }}" required>

    <label for="institution">Institución de educación:</label>
    <input type="text" name="institution" id="institution" value="{{ $curriculum->institution }}" required>

    <label for="start_date">Fecha de inicio en estudios:</label>
    <input type="date" name="start_date" id="start_date" value="{{ $curriculum->start_date }}" required>

    <label for="end_date">Fecha de término en estudios (opcional):</label>
    <input type="date" name="end_date" id="end_date" value="{{ $curriculum->end_date }}">

    <label for="courses">Cursos adicionales (opcional):</label>
    <textarea name="courses" id="courses">{{ $curriculum->courses }}</textarea>

    <label for="company">Nombre de la empresa:</label>
    <input type="text" name="company" id="company" value="{{ $curriculum->company }}" required>

    <label for="position">Cargo ocupado:</label>
    <input type="text" name="position" id="position" value="{{ $curriculum->position }}" required>

    <label for="job_start_date">Fecha de inicio en el trabajo:</label>
    <input type="date" name="job_start_date" id="job_start_date" value="{{ $curriculum->job_start_date }}" required>

    <label for="job_end_date">Fecha de término en el trabajo (opcional):</label>
    <input type="date" name="job_end_date" id="job_end_date" value="{{ $curriculum->job_end_date }}">

    <label for="job_description">Descripción de las funciones:</label>
    <textarea name="job_description" id="job_description" required>{{ $curriculum->job_description }}</textarea>

    <label for="references">Referencias laborales (opcional):</label>
    <textarea name="references" id="references">{{ $curriculum->references }}</textarea>

    <label for="skills">Habilidades (opcional):</label>
    <textarea name="skills" id="skills">{{ $curriculum->skills }}</textarea>

    <label for="languages">Idiomas (opcional):</label>
    <input type="text" name="languages" id="languages" value="{{ $curriculum->languages }}">

    <label for="salary_expectation">Expectativa de salario (opcional):</label>
    <input type="number" name="salary_expectation" id="salary_expectation" value="{{ $curriculum->salary_expectation }}" step="0.01">

    <label for="available">¿Disponibilidad inmediata?:</label>
    <input type="checkbox" name="available" id="available" value="1" {{ $curriculum->available ? 'checked' : '' }}>

    <label for="personal_references">Referencias personales (opcional):</label>
    <textarea name="personal_references" id="personal_references">{{ $curriculum->personal_references }}</textarea>

    <button type="submit">Actualizar</button>
</form>
@endsection
