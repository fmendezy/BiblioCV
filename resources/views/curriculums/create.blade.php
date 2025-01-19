@extends('layouts.app')

@section('content')
<h1>Crear nuevo currículum</h1>

<!-- Mostrar errores de validación -->
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('curriculums.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="name">Nombre completo:</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}" required>
    </div>

    <div class="form-group">
        <label for="rut">RUT:</label>
        <input type="text" name="rut" id="rut" value="{{ old('rut') }}" required placeholder="Formato: 12.345.678-9">
    </div>

    <div class="form-group">
        <label for="dob">Fecha de nacimiento:</label>
        <input type="date" name="dob" id="dob" value="{{ old('dob') }}" required>
    </div>

    <div class="form-group">
        <label for="address">Dirección:</label>
        <input type="text" name="address" id="address" value="{{ old('address') }}" required>
    </div>

    <div class="form-group">
        <label for="phone">Teléfono:</label>
        <input type="text" name="phone" id="phone" value="{{ old('phone') }}" required>
    </div>

    <div class="form-group">
        <label for="email">Correo electrónico:</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}" required>
    </div>

    <div class="form-group">
        <label for="civil_status">Estado civil:</label>
        <select name="civil_status" id="civil_status" required>
            <option value="Soltero(a)" {{ old('civil_status') == 'Soltero(a)' ? 'selected' : '' }}>Soltero(a)</option>
            <option value="Casado(a)" {{ old('civil_status') == 'Casado(a)' ? 'selected' : '' }}>Casado(a)</option>
            <option value="Divorciado(a)" {{ old('civil_status') == 'Divorciado(a)' ? 'selected' : '' }}>Divorciado(a)</option>
            <option value="Viudo(a)" {{ old('civil_status') == 'Viudo(a)' ? 'selected' : '' }}>Viudo(a)</option>
        </select>
    </div>

    <div class="form-group">
        <label for="photo">URL de la foto:</label>
        <input type="text" name="photo" id="photo" value="{{ old('photo') }}">
    </div>

    <div class="form-group">
        <label for="degree">Título profesional:</label>
        <input type="text" name="degree" id="degree" value="{{ old('degree') }}" required>
    </div>

    <div class="form-group">
        <label for="institution">Institución de educación:</label>
        <input type="text" name="institution" id="institution" value="{{ old('institution') }}" required>
    </div>

    <div class="form-group">
        <label for="start_date">Fecha de inicio en estudios:</label>
        <input type="date" name="start_date" id="start_date" value="{{ old('start_date') }}" required>
    </div>

    <div class="form-group">
        <label for="end_date">Fecha de término en estudios:</label>
        <input type="date" name="end_date" id="end_date" value="{{ old('end_date') }}">
    </div>

    <div class="form-group">
        <label for="courses">Cursos adicionales:</label>
        <textarea name="courses" id="courses">{{ old('courses') }}</textarea>
    </div>

    <div class="form-group">
        <label for="company">Nombre de la empresa:</label>
        <input type="text" name="company" id="company" value="{{ old('company') }}" required>
    </div>

    <div class="form-group">
        <label for="position">Cargo:</label>
        <input type="text" name="position" id="position" value="{{ old('position') }}" required>
    </div>

    <div class="form-group">
        <label for="job_start_date">Fecha de inicio en el trabajo:</label>
        <input type="date" name="job_start_date" id="job_start_date" value="{{ old('job_start_date') }}" required>
    </div>

    <div class="form-group">
        <label for="job_end_date">Fecha de término en el trabajo:</label>
        <input type="date" name="job_end_date" id="job_end_date" value="{{ old('job_end_date') }}">
    </div>

    <div class="form-group">
        <label for="job_description">Descripción de las funciones:</label>
        <textarea name="job_description" id="job_description">{{ old('job_description') }}</textarea>
    </div>

    <div class="form-group">
        <label for="references">Referencias laborales:</label>
        <textarea name="references" id="references">{{ old('references') }}</textarea>
    </div>

    <div class="form-group">
        <label for="skills">Habilidades:</label>
        <textarea name="skills" id="skills">{{ old('skills') }}</textarea>
    </div>

    <div class="form-group">
        <label for="languages">Idiomas:</label>
        <input type="text" name="languages" id="languages" value="{{ old('languages') }}">
    </div>

    <div class="form-group">
        <label for="salary_expectation">Expectativa de sueldo (en pesos chilenos):</label>
        <input type="number" name="salary_expectation" id="salary_expectation" value="{{ old('salary_expectation') }}" required step="1">
    </div>

    <div class="form-group">
        <label for="available">Disponibilidad inmediata:</label>
        <input type="checkbox" name="available" id="available" {{ old('available') ? 'checked' : '' }}>
    </div>

    <div class="form-group">
        <label for="personal_references">Referencias personales:</label>
        <textarea name="personal_references" id="personal_references">{{ old('personal_references') }}</textarea>
    </div>

    <button type="submit">Guardar</button>
</form>
@endsection
