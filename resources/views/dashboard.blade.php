<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel BiblioCV') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if(auth()->user()->role === 'employee')
                        <h3 class="text-lg font-bold">Bienvenido Funcionario</h3>
                        <p class="text-gray-600">Desde aquí puedes gestionar los currículums.</p>
                        <a href="{{ route('curriculums.index') }}" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded-md">
                            Gestionar Currículums
                        </a>
                    @elseif(auth()->user()->role === 'user')
                        <h3 class="text-lg font-bold">Bienvenido Usuario</h3>
                        <p class="text-gray-600">Aquí puedes ver tu perfil y descargar tu currículum.</p>
                        <a href="{{ route('profile.edit') }}" class="mt-4 inline-block bg-green-500 text-white px-4 py-2 rounded-md">
                            Editar Perfil
                        </a>
                    @else
                        <h3 class="text-lg font-bold">Bienvenido al sistema</h3>
                        <p class="text-gray-600">Tu rol no tiene permisos adicionales.</p>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
