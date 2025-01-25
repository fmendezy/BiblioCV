@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6">
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold">Gestión de Usuarios</h2>
            <a href="{{ route('users.create') }}" class="bg-gray-800 text-white px-4 py-2 rounded-md hover:bg-gray-700">
                Nuevo Usuario
            </a>
        </div>

        <!-- Buscador -->
        <form action="{{ route('users.index') }}" method="GET" class="mb-6">
            <input type="text" 
                   name="search"
                   placeholder="Buscar por RUT, nombre o email..." 
                   value="{{ request('search') }}"
                   class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        </form>

        @if (session('success'))
            <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-4" role="alert">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-700">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-4" role="alert">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">Se encontraron los siguientes errores:</h3>
                        <div class="mt-2 text-sm text-red-700">
                            <ul class="list-disc list-inside space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-16">
                            ID
                        </th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-32">
                            RUT
                        </th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-48">
                            Nombre
                        </th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Email
                        </th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-32">
                            Rol
                        </th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Biblioteca
                        </th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-40">
                            Registro
                        </th>
                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-28">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($users as $user)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-4 text-sm text-gray-500 whitespace-nowrap">
                                {{ $user->id }}
                            </td>
                            <td class="px-4 py-4 text-sm text-gray-900 whitespace-nowrap">
                                {{ $user->rut }}
                            </td>
                            <td class="px-4 py-4 text-sm text-gray-900 whitespace-nowrap">
                                {{ $user->name }}
                            </td>
                            <td class="px-4 py-4 text-sm text-gray-500 whitespace-nowrap">
                                {{ $user->email }}
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                @switch($user->role)
                                    @case('admin')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                                            Administrador
                                        </span>
                                        @break
                                    @case('employee')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                            Funcionario
                                        </span>
                                        @break
                                    @default
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Usuario
                                        </span>
                                @endswitch
                            </td>
                            <td class="px-4 py-4 text-sm text-gray-500 whitespace-nowrap">
                                @if($user->role === 'employee' && $user->library)
                                    {{ $user->library->name }}
                                @else
                                    -
                                @endif
                            </td>
                            <td class="px-4 py-4 text-sm text-gray-500 whitespace-nowrap">
                                {{ $user->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-4 py-4 text-sm font-medium whitespace-nowrap">
                                <a href="{{ route('users.edit', $user) }}" class="text-indigo-600 hover:text-indigo-900">
                                    Editar
                                </a>
                                @if ($user->id != auth()->id())
                                    <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline ml-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('¿Está seguro que desea eliminar al usuario {{ $user->name }}?')">
                                            Eliminar
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $users->links() }}
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
    window.location.href = '{{ route('users.index') }}?search=' + encodeURIComponent(searchValue);
}
</script>
@endsection 