@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Panel BiblioCV') }}
    </h2>
</div>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                @if(auth()->user()->role === 'employee')
                    <h3 class="text-lg font-bold">Bienvenido Funcionario</h3>
                    <p class="text-gray-600">Desde aquí puedes gestionar los currículums.</p>
                    <div class="mt-4 space-y-2">
                        <a href="{{ route('curriculums.index') }}" class="inline-block bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                            Gestionar Currículums
                        </a>
                    </div>
                @elseif(auth()->user()->role === 'user')
                    <h3 class="text-lg font-bold">Bienvenido Usuario</h3>
                    <p class="text-gray-600">Aquí puedes ver tu perfil y tus currículums.</p>
                    <div class="mt-4 space-y-2">
                        <a href="{{ route('curriculums.my') }}" class="inline-block bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                            Ver Mis Currículums
                        </a>
                        <a href="{{ route('profile.edit') }}" class="ml-2 inline-block bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">
                            Editar Perfil
                        </a>
                    </div>
                @else
                    <h3 class="text-lg font-bold">Bienvenido al sistema</h3>
                    <p class="text-gray-600">Tu rol no tiene permisos adicionales.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
