@extends('layouts.app')

@section('content')
<h1>Editar Usuario</h1>

<form action="{{ route('users.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label for="name">Nombre completo:</label>
    <input type="text" name="name" id="name" value="{{ $user->name }}" required>

    <label for="email">Correo electrónico:</label>
    <input type="email" name="email" id="email" value="{{ $user->email }}" required>

    <label for="password">Contraseña (opcional):</label>
    <input type="password" name="password" id="password">

    <label for="password_confirmation">Confirmar contraseña:</label>
    <input type="password" name="password_confirmation" id="password_confirmation">

    <button type="submit">Actualizar</button>
</form>
@endsection
