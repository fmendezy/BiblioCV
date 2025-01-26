@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Mensajes de alerta -->
        @if (session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <!-- Encabezado con título y botón de crear -->
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-semibold text-gray-800">Currículums</h2>
                <a href="{{ route('curriculums.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-colors duration-200 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Crear Nuevo CV
                </a>
            </div>

            <!-- Buscador -->
            <div class="mb-6">
                <div class="relative w-1/2">
                    <input type="text" id="search" 
                        class="w-full pr-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                        placeholder="Buscar por RUT, nombre o creador...">
                </div>
            </div>

            <!-- Tabla de currículums -->
            <div class="flex justify-center">
                <div id="curriculums-table" class="w-full max-w-6xl overflow-hidden">
                    @include('curriculums.partials.table')
                </div>
            </div>

            <!-- Paginación -->
            <div class="mt-4" id="pagination">
                {{ $curriculums->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    let searchTimeout;

    document.getElementById('search').addEventListener('input', function(e) {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            const query = e.target.value;
            searchCurriculums(query);
        }, 300);
    });

    async function searchCurriculums(query) {
        try {
            const response = await fetch(`/curriculums/search?query=${encodeURIComponent(query)}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            const data = await response.json();
            
            document.getElementById('curriculums-table').innerHTML = data.html;
            document.getElementById('pagination').innerHTML = data.pagination;
        } catch (error) {
            console.error('Error:', error);
        }
    }
</script>
@endpush 