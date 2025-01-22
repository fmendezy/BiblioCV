<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Currículum') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('curriculums.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-gray-700">RUT:</label>
                        <input type="text" name="rut" class="w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Nombre:</label>
                        <input type="text" name="name" class="w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Email:</label>
                        <input type="email" name="email" class="w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Teléfono:</label>
                        <input type="text" name="phone" class="w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Título Profesional:</label>
                        <input type="text" name="job_title" class="w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Resumen Profesional:</label>
                        <textarea name="profile_summary" class="w-full border-gray-300 rounded-md shadow-sm"></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Foto:</label>
                        <input type="file" name="photo" class="w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="mb-4">
                        <h3 class="text-lg font-bold">Formación Académica</h3>
                        <div id="education-section">
                            <div class="education-item">
                                <input type="text" name="education[][institution]" placeholder="Institución" class="w-full border-gray-300 rounded-md shadow-sm mb-2">
                                <input type="text" name="education[][degree]" placeholder="Título obtenido" class="w-full border-gray-300 rounded-md shadow-sm mb-2">
                                <input type="text" name="education[][start_year]" placeholder="Año de inicio" class="w-full border-gray-300 rounded-md shadow-sm mb-2">
                                <input type="text" name="education[][end_year]" placeholder="Año de finalización" class="w-full border-gray-300 rounded-md shadow-sm mb-2">
                            </div>
                        </div>
                        <button type="button" onclick="addEducation()">Agregar Formación</button>
                    </div>

                    <div class="mb-4">
                        <h3 class="text-lg font-bold">Experiencia Laboral</h3>
                        <div id="work-section">
                            <div class="work-item">
                                <input type="text" name="work[][position]" placeholder="Puesto" class="w-full border-gray-300 rounded-md shadow-sm mb-2">
                                <input type="text" name="work[][company]" placeholder="Empresa" class="w-full border-gray-300 rounded-md shadow-sm mb-2">
                                <input type="text" name="work[][start_date]" placeholder="Fecha inicio" class="w-full border-gray-300 rounded-md shadow-sm mb-2">
                                <input type="text" name="work[][end_date]" placeholder="Fecha fin" class="w-full border-gray-300 rounded-md shadow-sm mb-2">
                            </div>
                        </div>
                        <button type="button" onclick="addWork()">Agregar Experiencia</button>
                    </div>

                    <div class="mb-4">
                        <h3 class="text-lg font-bold">Habilidades</h3>
                        <textarea name="skills" class="w-full border-gray-300 rounded-md shadow-sm"></textarea>
                    </div>

                    <div class="mb-4">
                        <h3 class="text-lg font-bold">Referencias</h3>
                        <div id="reference-section">
                            <div class="reference-item">
                                <input type="text" name="references[][name]" placeholder="Nombre" class="w-full border-gray-300 rounded-md shadow-sm mb-2">
                                <input type="text" name="references[][position]" placeholder="Cargo" class="w-full border-gray-300 rounded-md shadow-sm mb-2">
                                <input type="text" name="references[][company]" placeholder="Empresa" class="w-full border-gray-300 rounded-md shadow-sm mb-2">
                                <input type="text" name="references[][phone]" placeholder="Teléfono" class="w-full border-gray-300 rounded-md shadow-sm mb-2">
                                <input type="text" name="references[][email]" placeholder="Email" class="w-full border-gray-300 rounded-md shadow-sm mb-2">
                            </div>
                        </div>
                        <button type="button" onclick="addReference()">Agregar Referencia</button>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">
                            Guardar Currículum
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function addEducation() {
        document.getElementById('education-section').innerHTML += document.querySelector('.education-item').outerHTML;
    }
    function addWork() {
        document.getElementById('work-section').innerHTML += document.querySelector('.work-item').outerHTML;
    }
    function addReference() {
        document.getElementById('reference-section').innerHTML += document.querySelector('.reference-item').outerHTML;
    }
</script>
