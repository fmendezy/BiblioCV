@extends('layouts.app')

@section('content')
<h1>Lista de Usuarios</h1>
<a href="{{ route('users.create') }}">Crear Nuevo Usuario</a>

<ul>
    @foreach ($users as $user)
        <li>
            {{ $user->name }} - {{ $user->email }}
            <a href="{{ route('users.show', $user->id) }}">Ver</a>
            <a href="{{ route('users.edit', $user->id) }}">Editar</a>
            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit">Eliminar</button>
            </form>
        </li>
    @endforeach
</ul>
@endsection
