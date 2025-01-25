<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

    <!-- RUT usuario -->
    <div class="mt-4">
            <x-input-label for="rut" :value="__('RUT')" />
            <x-text-input id="rut" class="block mt-1 w-full" type="text" name="rut" :value="old('rut')" maxlength="10"
                placeholder="11223344-5" x-data
                x-on:input="event.target.value = event.target.value.replace(/\./g, '').toUpperCase()"
                x-on:blur="event.target.value = event.target.value.replace(/^(\d{7,8})([kK0-9])$/, '$1-$2')"
                pattern="^\d{7,8}[-][0-9kK]{1}$" title="Formato: 11223344-5"
            />
            <x-input-error :messages="$errors->get('rut')" class="mt-2" />
        </div>

        <!-- Selección de rol -->
            <div class="mt-4">
        <x-input-label for="role" :value="__('Tipo de cuenta')" />
        <select id="role" name="role" required class="block mt-1 w-full">
            <option value="admin">Administrador</option>
            <option value="employee">Funcionario</option>
            <option value="user">Usuario</option>
        </select>
        <x-input-error :messages="$errors->get('role')" class="mt-2" />
    </div>

        <!-- Biblioteca -->
        <div class="mt-4">
            <x-input-label for="library_id" :value="__('Biblioteca')" />
            <select id="library_id" name="library_id" required class="block mt-1 w-full">
                <option value="">Seleccione una biblioteca</option>
                @foreach($libraries as $library)
                    <option value="{{ $library->id }}" {{ old('library_id') == $library->id ? 'selected' : '' }}>
                        {{ $library->name }}
                    </option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('library_id')" class="mt-2" />
        </div>

        <!-- Nombre -->
        <div>
            <x-input-label for="name" :value="__('Nombre')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Correo Electrónico -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Correo Electrónico')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Contraseña -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Contraseña')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirmar Contraseña -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

    <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('¿Ya estás registrado?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Registrarse') }}
            </x-primary-button>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const roleSelect = document.getElementById('role');
            const rutField = document.getElementById('rut-field');

            function toggleRutField() {
                if (roleSelect.value === 'user') {
                    rutField.style.display = 'block';
                } else {
                    rutField.style.display = 'none';
                }
            }

            roleSelect.addEventListener('change', toggleRutField);
            toggleRutField(); // Ejecutar al cargar la pagina
        });
    </script>

</x-guest-layout>
