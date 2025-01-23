<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <h2 class="text-2xl font-semibold mb-6">Crear Currículum</h2>
            <form action="{{ route('curriculums.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <x-input-label for="rut" :value="__('RUT')" />
                        <x-text-input id="rut" class="block mt-1 w-full rounded-md" type="text" name="rut" placeholder="Ingrese su RUT" required />
                    </div>
                    <div>
                        <x-input-label for="name" :value="__('Nombre')" />
                        <x-text-input id="name" class="block mt-1 w-full rounded-md" type="text" name="name" placeholder="Ingrese su nombre" required />
                    </div>
                    <div>
                        <x-input-label for="email" :value="__('Correo Electrónico')" />
                        <x-text-input id="email" class="block mt-1 w-full rounded-md" type="email" name="email" placeholder="ejemplo@correo.com" required />
                    </div>
                    <div>
                        <x-input-label for="phone" :value="__('Teléfono')" />
                        <x-text-input id="phone" class="block mt-1 w-full rounded-md" type="text" name="phone" placeholder="+56912345678" required />
                    </div>
                </div>
                <div class="mt-6">
                    <h3 class="text-xl font-semibold mb-2">Formación Académica</h3>
                    <div id="education-container">
                        <div class="grid grid-cols-2 gap-4">
                            <label>Institución</label>
                            <input type="text" name="institution[]" placeholder="Institución" class="block mt-1 w-full rounded-md">
                            <label>Título</label>
                            <input type="text" name="degree[]" placeholder="Título" class="block mt-1 w-full rounded-md">
                            <label>Fecha de Inicio</label>
                            <input type="date" name="education_start_date[]" class="block mt-1 w-full rounded-md">
                            <label>Fecha de Fin</label>
                            <input type="date" name="education_end_date[]" class="block mt-1 w-full rounded-md">
                        </div>
                    </div>
                </div>
                <div class="mt-6">
                    <h3 class="text-xl font-semibold mb-2">Experiencia Laboral</h3>
                    <div id="experience-container">
                        <label>Empresa</label>
                        <input type="text" name="company[]" placeholder="Nombre de la empresa" class="block mt-1 w-full rounded-md">
                        <label>Puesto</label>
                        <input type="text" name="position[]" placeholder="Cargo ocupado" class="block mt-1 w-full rounded-md">
                        <label>Fecha de Inicio</label>
                        <input type="date" name="experience_start_date[]" class="block mt-1 w-full rounded-md">
                        <label>Fecha de Fin</label>
                        <input type="date" name="experience_end_date[]" class="block mt-1 w-full rounded-md">
                    </div>
                </div>
                <div class="mt-6">
                    <h3 class="text-xl font-semibold mb-2">Habilidades</h3>
                    <div id="skills-container">
                        <label>Habilidad</label>
                        <input type="text" name="skills[]" placeholder="Ingrese habilidad" class="block mt-1 w-full rounded-md">
                    </div>
                </div>
                <div class="mt-6">
                    <h3 class="text-xl font-semibold mb-2">Referencias Personales</h3>
                    <div id="reference-container">
                        <div class="grid grid-cols-3 gap-4">
                            <div>
                                <label>Nombre</label>
                                <input type="text" name="reference_name[]" placeholder="Nombre" class="block mt-1 w-full rounded-md">
                            </div>
                            <div>
                                <label>Relación</label>
                                <input type="text" name="relation[]" placeholder="Relación" class="block mt-1 w-full rounded-md">
                            </div>
                            <div>
                                <label>Contacto</label>
                                <input type="text" name="contact_info[]" placeholder="Contacto" class="block mt-1 w-full rounded-md">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-end mt-6">
                    <x-primary-button class="ms-4">
                        {{ __('Guardar y Generar PDF') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
