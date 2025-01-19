@extends('layouts.app')

@section('content')
<h1>Detalle del Usuario</h1>

<p><strong>Nombre completo:</strong> {{ $user->name }}</p>
<p><strong>Correo electrónico:</strong> {{ $user->email }}</p>

<a href="{{ route('users.edit', $user->id) }}">Editar</a>

<form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?');">Eliminar</button>
</form>

@endsection
