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

                    <div>
                        <x-input-label for="civil_status" :value="__('Estado Civil')" />
                        <select id="civil_status" name="civil_status" class="block mt-1 w-full rounded-md">
                            <option value="Soltero(a)">Soltero(a)</option>
                            <option value="Casado(a)">Casado(a)</option>
                            <option value="Divorciado(a)">Divorciado(a)</option>
                            <option value="Viudo(a)">Viudo(a)</option>
                        </select>
                    </div>

                    <div>
                        <x-input-label for="profile_image" :value="__('Foto de Perfil (URL o Archivo)')" />
                        <x-text-input id="profile_image" class="block mt-1 w-full rounded-md" type="url" name="profile_image" placeholder="https://imagen.com/foto.jpg" />
                        <input type="file" name="photo_file" accept="image/png, image/jpeg, image/gif" class="mt-2" onchange="previewImage(event)">
                        <img id="preview" src="" class="mt-2 rounded-md" style="max-width: 150px; display: none;">
                    </div>

                    <div>
                        <x-input-label for="summary" :value="__('Resumen Profesional')" />
                        <textarea id="summary" name="summary" class="block mt-1 w-full rounded-md" placeholder="Describa su perfil profesional aquí"></textarea>
                    </div>
                </div>

                <div class="mt-6">
                    <h3 class="text-xl font-semibold mb-2">Formación Académica</h3>
                    <div id="education-container">
                        <div class="grid grid-cols-2 gap-4">
                            <label class="block text-sm font-medium text-gray-700">Institución</label>
                            <input type="text" name="institution[]" placeholder="Institución" class="block mt-1 w-full rounded-md">
                            <label class="block text-sm font-medium text-gray-700">Título</label>
                            <input type="text" name="degree[]" placeholder="Título" class="block mt-1 w-full rounded-md">
                        </div>
                    </div>
                    <button type="button" class="mt-2 text-blue-600" onclick="addEducation()">Agregar Formación</button>
                </div>

                <div class="mt-6">
                    <h3 class="text-xl font-semibold mb-2">Experiencia Laboral</h3>
                    <div id="experience-container">
                        <label class="block text-sm font-medium text-gray-700">Empresa</label>
                        <input type="text" name="company[]" placeholder="Nombre de la empresa" class="block mt-1 w-full rounded-md">
                        <label class="block text-sm font-medium text-gray-700">Puesto</label>
                        <input type="text" name="position[]" placeholder="Cargo ocupado" class="block mt-1 w-full rounded-md">
                    </div>
                    <button type="button" class="mt-2 text-blue-600" onclick="addExperience()">Agregar Experiencia</button>
                </div>

                <div class="mt-6">
                    <h3 class="text-xl font-semibold mb-2">Habilidades</h3>
                    <div id="skills-container">
                        <x-input-label :value="__('Habilidad')" />
                        <x-text-input type="text" name="skills[]" placeholder="Ingrese habilidad" class="block mt-1 w-full rounded-md" />
                    </div>
                    <button type="button" class="mt-2 text-blue-600" onclick="addSkill()">Agregar Habilidad</button>
                </div>

                <div class="mt-6">
                    <h3 class="text-xl font-semibold mb-2">Referencias Personales</h3>
                    <div id="reference-container">
                        <div class="grid grid-cols-3 gap-4">
                            <div>
                                <x-input-label :value="__('Nombre')" />
                                <x-text-input type="text" name="reference_name[]" placeholder="Nombre" class="block mt-1 w-full rounded-md" />
                            </div>
                            <div>
                                <x-input-label :value="__('Relación')" />
                                <x-text-input type="text" name="relation[]" placeholder="Relación" class="block mt-1 w-full rounded-md" />
                            </div>
                            <div>
                                <x-input-label :value="__('Contacto')" />
                                <x-text-input type="text" name="contact_info[]" placeholder="Contacto" class="block mt-1 w-full rounded-md" />
                            </div>
                        </div>
                    </div>
                    <button type="button" class="mt-2 text-blue-600" onclick="addReference()">Agregar Referencia</button>
                </div>

                <div class="flex items-center justify-end mt-6">
                    <x-primary-button class="ms-4">
                        {{ __('Guardar y Generar PDF') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function(){
                document.getElementById('preview').src = reader.result;
                document.getElementById('preview').style.display = 'block';
            };
            reader.readAsDataURL(event.target.files[0]);
        }

        function addEducation() {
            document.getElementById('education-container').insertAdjacentHTML('beforeend', `
                <div class="grid grid-cols-2 gap-4 mt-2">
                    <label class="block text-sm font-medium text-gray-700">Institución</label>
                    <input type="text" name="institution[]" placeholder="Institución" class="block mt-1 w-full rounded-md">
                    <label class="block text-sm font-medium text-gray-700">Título</label>
                    <input type="text" name="degree[]" placeholder="Título" class="block mt-1 w-full rounded-md">
                </div>`);
        }

        function addExperience() {
            document.getElementById('experience-container').insertAdjacentHTML('beforeend', `
                <label class="block text-sm font-medium text-gray-700">Empresa</label>
                <input type="text" name="company[]" placeholder="Nombre de la empresa" class="block mt-1 w-full rounded-md">
                <label class="block text-sm font-medium text-gray-700">Puesto</label>
                <input type="text" name="position[]" placeholder="Cargo ocupado" class="block mt-1 w-full rounded-md">
            `);
        }

        function addSkill() {
            document.getElementById('skills-container').innerHTML += `
                <div class="mt-2">
                    <x-input-label :value="__('Habilidad')" />
                    <input type="text" name="skills[]" placeholder="Ingrese habilidad" class="block mt-1 w-full rounded-md" />
                </div>`;
        }

        function addReference() {
            document.getElementById('reference-container').innerHTML += `
                <div class="grid grid-cols-3 gap-4 mt-2">
                    <div>
                        <x-input-label :value="__('Nombre')" />
                        <input type="text" name="reference_name[]" placeholder="Nombre" class="block mt-1 w-full rounded-md" />
                    </div>
                    <div>
                        <x-input-label :value="__('Relación')" />
                        <input type="text" name="relation[]" placeholder="Relación" class="block mt-1 w-full rounded-md" />
                    </div>
                    <div>
                        <x-input-label :value="__('Contacto')" />
                        <input type="text" name="contact_info[]" placeholder="Contacto" class="block mt-1 w-full rounded-md" />
                    </div>
                </div>`;
        }
    </script>
</x-app-layout>