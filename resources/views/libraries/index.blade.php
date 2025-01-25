@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6">
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold">Gestionar Bibliotecas</h2>
            <a href="{{ route('libraries.create') }}" class="bg-gray-800 text-white px-4 py-2 rounded-md hover:bg-gray-700">
                Nueva Biblioteca
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <!-- Buscador -->
        <form action="{{ route('libraries.index') }}" method="GET" class="mb-6">
            <input type="text" 
                   name="search"
                   placeholder="Buscar por nombre, dirección o email..." 
                   value="{{ request('search') }}"
                   class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        </form>

        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-64">
                            Nombre
                        </th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Dirección
                        </th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-40">
                            Teléfono
                        </th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Email
                        </th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-24">
                            Usuarios
                        </th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-28">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($libraries as $library)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-4 text-sm text-gray-900 whitespace-nowrap">
                                {{ $library->name }}
                            </td>
                            <td class="px-4 py-4 text-sm text-gray-500 whitespace-nowrap">
                                {{ $library->address }}
                            </td>
                            <td class="px-4 py-4 text-sm text-gray-500 whitespace-nowrap">
                                {{ $library->phone }}
                            </td>
                            <td class="px-4 py-4 text-sm text-gray-500 whitespace-nowrap">
                                {{ $library->email }}
                            </td>
                            <td class="px-4 py-4 text-sm text-gray-500 whitespace-nowrap text-center">
                                {{ $library->users_count }}
                            </td>
                            <td class="px-4 py-4 text-sm font-medium whitespace-nowrap">
                                <a href="{{ route('libraries.edit', $library) }}" class="text-indigo-600 hover:text-indigo-900">
                                    Editar
                                </a>
                                <a href="{{ route('users.index', ['search' => $library->name]) }}" class="text-blue-600 hover:text-blue-900 ml-2">
                                    Usuarios
                                </a>
                                <form action="{{ route('libraries.destroy', $library) }}" method="POST" class="inline ml-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('¿Está seguro que desea eliminar la biblioteca {{ $library->name }}?')">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $libraries->links() }}
        </div>
    </div>
</div>

<script>
let typingTimer;
const doneTypingInterval = 300; // Tiempo en ms para esperar después de que el usuario deja de escribir

document.getElementById('searchInput').addEventListener('input', function() {
    clearTimeout(typingTimer);
    typingTimer = setTimeout(performSearch, doneTypingInterval);
});

function performSearch() {
    const searchValue = document.getElementById('searchInput').value;
    window.location.href = '{{ route('libraries.index') }}?search=' + encodeURIComponent(searchValue);
}
</script>
@endsection 