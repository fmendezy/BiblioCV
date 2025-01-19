<!--  Esta vista mostrará todos los cv guardados en la base de datos. -->
@extends('layouts.app')

@section('content')
<h1>Lista de Currículums</h1>
<a href="{{ route('curriculums.create') }}">Crear Nuevo Currículum</a>

<ul>
    @foreach ($curriculums as $curriculum)
        <li>
            {{ $curriculum->name }} - {{ $curriculum->email }}
            <a href="{{ route('curriculums.show', $curriculum->id) }}">Ver</a>
            <a href="{{ route('curriculums.edit', $curriculum->id) }}">Editar</a>
            <form action="{{ route('curriculums.destroy', $curriculum->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit">Eliminar</button>
            </form>
        </li>
    @endforeach
</ul>
@endsection
