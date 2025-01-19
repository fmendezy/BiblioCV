@extends('layouts.app')

@section('content')
<h1>Crear nuevo usuario</h1>

<form action="{{ route('users.store') }}" method="POST">
    @csrf

    <label for="name">Nombre completo:</label>
    <input type="text" name="name" id="name" required>

    <label for="email">Correo electrónico:</label>
    <input type="email" name="email" id="email" required>

    <label for="password">Contraseña:</label>
    <input type="password" name="password" id="password" required>

    <label for="password_confirmation">Confirmar contraseña:</label>
    <input type="password" name="password_confirmation" id="password_confirmation" required>

    <button type="submit">Guardar</button>
</form>
@endsection
