@extends('layouts.app')

@section('content')
<!-- Agregar CSS de Cropper.js en el head -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css">

<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6 mb-16">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold">Crear Currículum</h2>
            <button type="button" onclick="precargarDatos()" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-500">
                Precargar Datos de Ejemplo
            </button>
        </div>
        
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

        <form action="{{ route('curriculums.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
            <!-- Información Personal -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                    <label for="rut" class="block font-medium text-sm text-gray-700">RUT</label>
                    <input id="rut" type="text" name="rut" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        value="{{ old('rut') }}" required pattern="^\d{7,8}[-][0-9kK]{1}$" title="Formato: 11223344-5">
                </div>
                <div>
                    <label for="name" class="block font-medium text-sm text-gray-700">Nombre Completo</label>
                    <input id="name" type="text" name="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        value="{{ old('name') }}" required minlength="3" maxlength="255">
                    </div>
                    <div>
                    <label for="birthdate" class="block font-medium text-sm text-gray-700">Fecha de Nacimiento</label>
                    <input id="birthdate" type="date" name="birthdate" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        value="{{ old('birthdate') }}" required
                        onchange="validateAge(this)">
                    </div>
                    <div>
                    <label for="marital_status" class="block font-medium text-sm text-gray-700">Estado Civil</label>
                    <select id="marital_status" name="marital_status" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        required>
                        <option value="">Seleccionar...</option>
                        <option value="Soltero/a">Soltero/a</option>
                        <option value="Casado/a">Casado/a</option>
                        <option value="Divorciado/a">Divorciado/a</option>
                        <option value="Viudo/a">Viudo/a</option>
                        <option value="Conviviente Civil">Conviviente Civil</option>
                    </select>
                    </div>
                    <div>
                    <label for="email" class="block font-medium text-sm text-gray-700">Correo Electrónico</label>
                    <input id="email" type="email" name="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        value="{{ old('email') }}" required>
                    </div>
                <div>
                    <label for="phone" class="block font-medium text-sm text-gray-700">Teléfono</label>
                    <input id="phone" type="tel" name="phone" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        value="{{ old('phone') }}" required pattern="^\+?56?\d{9}$" title="Formato: +56912345678">
                </div>
            </div>

            <!-- Foto y Título Profesional -->
                <div class="mt-6">
                <div class="flex flex-col items-center justify-center space-y-4">
                    <!-- Foto de perfil -->
                    <div class="relative">
                        <div id="photo-preview" class="w-20 h-20 rounded-full bg-gray-100 flex items-center justify-center overflow-hidden border-2 border-gray-300 hover:border-indigo-500 transition-colors duration-200">
                            <svg class="h-10 w-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <input type="file" id="photo" name="photo" accept="image/*" class="hidden" onchange="showImageCropper(this)">
                        <button type="button" onclick="document.getElementById('photo').click()" 
                            class="bg-gray-800 text-white px-4 py-2 rounded-md hover:bg-gray-700 mt-2 w-full flex items-center justify-center space-x-2">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span>Seleccionar una imagen</span>
                        </button>
                    </div>
                    <div class="text-center mt-2">
                        <p class="text-xs text-gray-400">Tamaño máximo: 1MB</p>
                    </div>

                    <!-- Título profesional -->
                    <div class="w-full max-w-lg">
                        <label for="job_title" class="block font-medium text-sm text-gray-700 text-center">Título Profesional</label>
                        <input id="job_title" type="text" name="job_title" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-center"
                            value="{{ old('job_title') }}" placeholder="Ej: Ingeniero en Informática">
                    </div>
                </div>
            </div>

            <!-- Resumen del perfil -->
            <div class="mt-4">
                <label for="profile_summary" class="block font-medium text-sm text-gray-700">Resumen Profesional</label>
                <textarea id="profile_summary" name="profile_summary" rows="3" 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    placeholder="Breve descripción de tu perfil profesional">{{ old('profile_summary') }}</textarea>
            </div>

            <!-- Resumen general -->
            <div class="mt-4">
                <label for="summary" class="block font-medium text-sm text-gray-700">Resumen General</label>
                <textarea id="summary" name="summary" rows="3" 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    placeholder="Información adicional relevante">{{ old('summary') }}</textarea>
            </div>

            <!-- Modal para recortar la imagen -->
            <div id="cropperModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center z-50">
                <div class="bg-white p-6 rounded-lg shadow-xl max-w-lg w-full">
                    <div class="mb-4">
                        <h3 class="text-lg font-medium">Ajustar imagen de perfil</h3>
                        <p class="text-sm text-gray-500">Mueve y ajusta la imagen para obtener el mejor resultado</p>
                    </div>
                    <div class="relative w-full" style="height: 300px;">
                        <img id="cropperImage" src="" alt="Imagen para recortar" class="max-w-full">
                    </div>
                    <div class="mt-4 flex justify-end space-x-3">
                        <button type="button" onclick="cancelCrop()" 
                            class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">
                            Cancelar
                        </button>
                        <button type="button" onclick="cropImage()" 
                            class="px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700">
                            Aplicar
                        </button>
                    </div>
                </div>
            </div>

            <!-- Script para validación de edad -->
            <script>
                function validateAge(input) {
                    const birthDate = new Date(input.value);
                    const today = new Date();
                    let age = today.getFullYear() - birthDate.getFullYear();
                    const monthDiff = today.getMonth() - birthDate.getMonth();
                    
                    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                        age--;
                    }

                    if (age < 15) {
                        alert('Debes tener al menos 15 años para crear un currículum.');
                        input.value = '';
                    }
                }
            </script>

            <!-- Formación Académica -->
            <div class="mt-6" id="education-section">
                <h3 class="text-lg font-medium mb-4">Formación Académica</h3>
                <div id="education-container">
                    <div class="education-entry grid grid-cols-2 gap-4 p-4 border rounded-lg mb-4">
                        <div>
                            <label class="block font-medium text-sm text-gray-700">Institución</label>
                            <input type="text" name="institution[]" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                        <div>
                            <label class="block font-medium text-sm text-gray-700">Título</label>
                            <input type="text" name="degree[]" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                        <div>
                            <label class="block font-medium text-sm text-gray-700">Fecha de Inicio</label>
                            <input type="date" name="education_start_date[]" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                        <div>
                            <label class="block font-medium text-sm text-gray-700">Fecha de Fin</label>
                            <input type="date" name="education_end_date[]" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                    </div>
                </div>
                <button type="button" onclick="addEducation()" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Agregar Formación
                </button>
            </div>

            <!-- Experiencia Laboral -->
            <div class="mt-6" id="experience-section">
                <h3 class="text-lg font-medium mb-4">Experiencia Laboral</h3>
                <div id="experience-container">
                    <div class="experience-entry p-4 border rounded-lg mb-4">
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block font-medium text-sm text-gray-700">Empresa</label>
                                <input type="text" name="company[]" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label class="block font-medium text-sm text-gray-700">Cargo</label>
                                <input type="text" name="position[]" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label class="block font-medium text-sm text-gray-700">Fecha de Inicio</label>
                                <input type="date" name="experience_start_date[]" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label class="block font-medium text-sm text-gray-700">Fecha de Fin</label>
                                <input type="date" name="experience_end_date[]" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                        </div>
                        <div>
                            <label class="block font-medium text-sm text-gray-700">Descripción</label>
                            <textarea name="job_description[]" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                        </div>
                    </div>
                </div>
                <button type="button" onclick="addExperience()" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Agregar Experiencia
                </button>
            </div>

            <!-- Habilidades -->
            <div class="mt-6" id="skills-section">
                <h3 class="text-lg font-medium mb-4">Habilidades</h3>
                <div id="skills-container">
                    <div class="skill-entry grid grid-cols-1 gap-4 p-4 border rounded-lg mb-4">
                        <div>
                            <label class="block font-medium text-sm text-gray-700">Habilidad</label>
                            <input type="text" name="skills[]" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                    </div>
                </div>
                <button type="button" onclick="addSkill()" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Agregar Habilidad
                </button>
            </div>

            <!-- Referencias -->
            <div class="mt-6" id="references-section">
                <h3 class="text-lg font-medium mb-4">Referencias</h3>
                <div id="references-container">
                    <div class="reference-entry grid grid-cols-3 gap-4 p-4 border rounded-lg mb-4">
                        <div>
                            <label class="block font-medium text-sm text-gray-700">Nombre</label>
                            <input type="text" name="reference_name[]" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                        <div>
                            <label class="block font-medium text-sm text-gray-700">Relación</label>
                            <input type="text" name="relation[]" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                        <div>
                            <label class="block font-medium text-sm text-gray-700">Contacto</label>
                            <input type="text" name="contact_info[]" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                pattern="^\+?56?\d{9}$|^[^@]+@[^@]+\.[a-zA-Z]{2,}$" title="Ingrese un teléfono o correo válido">
                        </div>
                    </div>
                </div>
                <button type="button" onclick="addReference()" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Agregar Referencia
                </button>
            </div>

            <!-- Botones del formulario -->
            <div class="flex items-center justify-end mt-6 space-x-8">
                <button type="button" onclick="precargarDatos()" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Precargar Datos de Ejemplo
                </button>
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Guardar y Generar PDF
                </button>
            </div>
            </form>
    </div>
</div>

<!-- Modal de éxito - En Desarrollo -->
<div id="successModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-xl max-w-md w-full">
        <div class="text-center">
            <h3 class="text-2xl font-bold text-gray-900 mb-4">¡El currículum de <span id="userName"></span> ya está listo!</h3>
            
            <div class="space-y-4 mt-6">
                <button onclick="downloadPDF()" class="w-full flex items-center justify-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 101.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                    Imprimir y descargar
                </button>
                
                <button onclick="createNewCV()" class="w-full px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition-colors">
                    Crear otro CV
                </button>
                
                <button onclick="goToDashboard()" class="w-full px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 transition-colors">
                    Volver al Dashboard
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Agregar script de Cropper.js antes de cerrar el body -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>

<script>
    let pdfBlob = null;
    let cropper = null;
    let croppedImageData = null;

    function addEducation() {
        const container = document.getElementById('education-container');
        const template = container.querySelector('.education-entry').cloneNode(true);
        clearInputs(template);
        container.appendChild(template);
    }

    function addExperience() {
        const container = document.getElementById('experience-container');
        const template = container.querySelector('.experience-entry').cloneNode(true);
        clearInputs(template);
        container.appendChild(template);
    }

    function addSkill() {
        const container = document.getElementById('skills-container');
        const template = container.querySelector('.skill-entry').cloneNode(true);
        clearInputs(template);
        container.appendChild(template);
    }

    function addReference() {
        const container = document.getElementById('references-container');
        const template = container.querySelector('.reference-entry').cloneNode(true);
        clearInputs(template);
        container.appendChild(template);
    }

    function clearInputs(element) {
        element.querySelectorAll('input, textarea').forEach(input => {
            input.value = '';
        });
    }

    function precargarDatos() {
        // Datos personales
        document.getElementById('rut').value = '18556322-7';
        document.getElementById('name').value = 'Francisco Mendez';
        document.getElementById('email').value = 'francisco@bibliocv.cl';
        document.getElementById('phone').value = '+56934174123';
        document.getElementById('birthdate').value = '1994-02-02';
        document.getElementById('marital_status').value = 'Soltero/a';

        // Título profesional y resúmenes
        document.getElementById('job_title').value = 'Estudiante de Ingeniería Informática | Desarrollador Full Stack';
        document.getElementById('profile_summary').value = 'Estudiante de Informática con más de X años de experiencia en desarrollo web full stack. Especializado en la creación de aplicaciones web modernas y escalables utilizando Laravel, Vue.js y Tailwind CSS. Apasionado por la arquitectura de software limpia y las mejores prácticas de desarrollo. Experiencia comprobada en la implementación de soluciones tecnológicas que mejoran la eficiencia y la experiencia del usuario.';
        document.getElementById('summary').value = 'Disponibilidad inmediata para trabajar en modalidad presencial o remota. Nivel de inglés intermedio-avanzado (B2). Certificado en metodologías ágiles Scrum. Constante aprendizaje de nuevas tecnologías y frameworks.';

        // Formación académica
        const educationContainer = document.getElementById('education-container');
        educationContainer.innerHTML = '';
        
        // Primera entrada de educación
        const educationTemplate = `
            <div class="education-entry grid grid-cols-2 gap-4 p-4 border rounded-lg mb-4">
                <div>
                    <label class="block font-medium text-sm text-gray-700">Institución</label>
                    <input type="text" name="institution[]" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>
                <div>
                    <label class="block font-medium text-sm text-gray-700">Título</label>
                    <input type="text" name="degree[]" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>
                <div>
                    <label class="block font-medium text-sm text-gray-700">Fecha de Inicio</label>
                    <input type="date" name="education_start_date[]" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>
                <div>
                    <label class="block font-medium text-sm text-gray-700">Fecha de Fin</label>
                    <input type="date" name="education_end_date[]" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>
            </div>
        `;
        
        // Agregar primera entrada de educación
        educationContainer.insertAdjacentHTML('beforeend', educationTemplate);
        const educationEntry1 = educationContainer.lastElementChild;
        educationEntry1.querySelector('input[name="institution[]"]').value = 'IPLACEX';
        educationEntry1.querySelector('input[name="degree[]"]').value = 'Ingeniero en Informática';
        educationEntry1.querySelector('input[name="education_start_date[]"]').value = '2023-03-01';
        educationEntry1.querySelector('input[name="education_end_date[]"]').value = '2026-12-15';

        // Agregar segunda entrada de educación
        educationContainer.insertAdjacentHTML('beforeend', educationTemplate);
        const educationEntry2 = educationContainer.lastElementChild;
        educationEntry2.querySelector('input[name="institution[]"]').value = 'Instituto Profesional AIEP';
        educationEntry2.querySelector('input[name="degree[]"]').value = 'Técnico en Programación';
        educationEntry2.querySelector('input[name="education_start_date[]"]').value = '2020-03-01';
        educationEntry2.querySelector('input[name="education_end_date[]"]').value = '2022-12-15';

        // Experiencia laboral
        const experienceContainer = document.getElementById('experience-container');
        experienceContainer.innerHTML = '';
        
        // Template para experiencia
        const experienceTemplate = `
            <div class="experience-entry p-4 border rounded-lg mb-4">
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block font-medium text-sm text-gray-700">Empresa</label>
                        <input type="text" name="company[]" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="block font-medium text-sm text-gray-700">Cargo</label>
                        <input type="text" name="position[]" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="block font-medium text-sm text-gray-700">Fecha de Inicio</label>
                        <input type="date" name="experience_start_date[]" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="block font-medium text-sm text-gray-700">Fecha de Fin</label>
                        <input type="date" name="experience_end_date[]" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                </div>
                <div>
                    <label class="block font-medium text-sm text-gray-700">Descripción</label>
                    <textarea name="job_description[]" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                </div>
            </div>
        `;

        // Agregar primera entrada de experiencia
        experienceContainer.insertAdjacentHTML('beforeend', experienceTemplate);
        const experienceEntry1 = experienceContainer.lastElementChild;
        experienceEntry1.querySelector('input[name="company[]"]').value = 'Empresa Ejemplo S.A.';
        experienceEntry1.querySelector('input[name="position[]"]').value = 'Desarrollador Full Stack Senior';
        experienceEntry1.querySelector('input[name="experience_start_date[]"]').value = '2021-01-01';
        experienceEntry1.querySelector('input[name="experience_end_date[]"]').value = '2023-12-31';
        experienceEntry1.querySelector('textarea[name="job_description[]"]').value = 'Desarrollo y mantenimiento de aplicaciones web empresariales utilizando Laravel y Vue.js. Implementación de arquitecturas escalables y patrones de diseño. Optimización de rendimiento y seguridad de aplicaciones. Integración con APIs externas y servicios de terceros. Mentoría a desarrolladores junior y liderazgo técnico en proyectos clave.';

        // Agregar segunda entrada de experiencia
        experienceContainer.insertAdjacentHTML('beforeend', experienceTemplate);
        const experienceEntry2 = experienceContainer.lastElementChild;
        experienceEntry2.querySelector('input[name="company[]"]').value = 'Tecnología Innovadora Ltda.';
        experienceEntry2.querySelector('input[name="position[]"]').value = 'Desarrollador Full Stack';
        experienceEntry2.querySelector('input[name="experience_start_date[]"]').value = '2019-03-01';
        experienceEntry2.querySelector('input[name="experience_end_date[]"]').value = '2020-12-31';
        experienceEntry2.querySelector('textarea[name="job_description[]"]').value = 'Desarrollo de aplicaciones web con PHP y MySQL. Implementación de interfaces de usuario responsivas con Bootstrap y jQuery. Mantenimiento y optimización de bases de datos. Colaboración en equipo utilizando metodologías ágiles. Soporte técnico a clientes y resolución de incidencias.';

        // Habilidades
        const skillsContainer = document.getElementById('skills-container');
        skillsContainer.innerHTML = '';
        
        // Template para habilidades
        const skillTemplate = `
            <div class="skill-entry grid grid-cols-1 gap-4 p-4 border rounded-lg mb-4">
                <div>
                    <label class="block font-medium text-sm text-gray-700">Habilidad</label>
                    <input type="text" name="skills[]" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>
            </div>
        `;

        // Agregar habilidades
        const skills = [
            'Laravel',, 'PHP', 'JavaScript', 'MySQL', 
            'Git', 'Docker', 'Tailwind CSS',
            'Node.js', 'Linux'
        ];
        
        skills.forEach(skill => {
            skillsContainer.insertAdjacentHTML('beforeend', skillTemplate);
            const skillEntry = skillsContainer.lastElementChild;
            skillEntry.querySelector('input[name="skills[]"]').value = skill;
        });

        // Referencias
        const referencesContainer = document.getElementById('references-container');
        referencesContainer.innerHTML = '';
        
        // Template para referencias
        const referenceTemplate = `
            <div class="reference-entry grid grid-cols-3 gap-4 p-4 border rounded-lg mb-4">
                <div>
                    <label class="block font-medium text-sm text-gray-700">Nombre</label>
                    <input type="text" name="reference_name[]" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>
                <div>
                    <label class="block font-medium text-sm text-gray-700">Relación</label>
                    <input type="text" name="relation[]" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>
                <div>
                    <label class="block font-medium text-sm text-gray-700">Contacto</label>
                    <input type="text" name="contact_info[]" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        pattern="^\+?56?\d{9}$|^[^@]+@[^@]+\.[a-zA-Z]{2,}$" title="Ingrese un teléfono o correo válido">
                </div>
            </div>
        `;

        // Agregar primera referencia
        referencesContainer.insertAdjacentHTML('beforeend', referenceTemplate);
        const referenceEntry1 = referencesContainer.lastElementChild;
        referenceEntry1.querySelector('input[name="reference_name[]"]').value = 'Juan Pérez';
        referenceEntry1.querySelector('input[name="relation[]"]').value = 'Jefe de Desarrollo';
        referenceEntry1.querySelector('input[name="contact_info[]"]').value = '+56987654321';

        // Agregar segunda referencia
        referencesContainer.insertAdjacentHTML('beforeend', referenceTemplate);
        const referenceEntry2 = referencesContainer.lastElementChild;
        referenceEntry2.querySelector('input[name="reference_name[]"]').value = 'María González';
        referenceEntry2.querySelector('input[name="relation[]"]').value = 'Gerente de Proyectos';
        referenceEntry2.querySelector('input[name="contact_info[]"]').value = 'maria.gonzalez@empresa.cl';
    }

    // Función para manejar el envío del formulario
    document.querySelector('form').addEventListener('submit', async function(e) {
        e.preventDefault();
        const form = e.target;
        const formData = new FormData(form);

        try {
            const response = await fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });

            if (!response.ok) {
                if (response.headers.get('content-type')?.includes('application/json')) {
                    const data = await response.json();
                    // Remover mensajes de error anteriores
                    const previousError = form.querySelector('.bg-red-50');
                    if (previousError) {
                        previousError.remove();
                    }

                    // Crear el nuevo mensaje de error
                    const errorDiv = document.createElement('div');
                    errorDiv.className = 'bg-red-50 border-l-4 border-red-400 p-4 mb-4';
                    errorDiv.setAttribute('role', 'alert');
                    
                    let errorMessages = '';
                    if (data.errors) {
                        Object.entries(data.errors).forEach(([field, messages]) => {
                            messages.forEach(message => {
                                errorMessages += `<li>${message}</li>`;
                            });
                        });
                    } else {
                        errorMessages = `<li>${data.message}</li>`;
                    }

                    errorDiv.innerHTML = `
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
                                        ${errorMessages}
                                    </ul>
                                </div>
                            </div>
                        </div>
                    `;
                    
                    form.insertBefore(errorDiv, form.firstChild);
                    window.scrollTo(0, 0);
                }
                return;
            }

            // Si la respuesta es exitosa y es un PDF
            if (response.headers.get('content-type')?.includes('application/pdf')) {
                pdfBlob = await response.blob();
                const userName = document.getElementById('name').value;
                document.getElementById('userName').textContent = userName;
                document.getElementById('successModal').classList.remove('hidden');
                
                // Crear una URL temporal para el PDF
                const pdfUrl = URL.createObjectURL(pdfBlob);
                
                // Guardar la URL para usarla cuando se haga clic en el botón de descarga
                document.getElementById('successModal').setAttribute('data-pdf-url', pdfUrl);
            }

        } catch (error) {
            console.error('Error:', error);
            const errorDiv = document.createElement('div');
            errorDiv.className = 'bg-red-50 border-l-4 border-red-400 p-4 mb-4';
            errorDiv.innerHTML = `
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">Error:</h3>
                        <div class="mt-2 text-sm text-red-700">
                            <p>${error.message}</p>
                        </div>
                    </div>
                </div>
            `;
            form.insertBefore(errorDiv, form.firstChild);
            window.scrollTo(0, 0);
        }
    });

    function downloadPDF() {
        const pdfUrl = document.getElementById('successModal').getAttribute('data-pdf-url');
        if (pdfUrl) {
            window.open(pdfUrl, '_blank');
        }
    }

    function createNewCV() {
        // Ocultar el modal
        document.getElementById('successModal').classList.add('hidden');
        // Limpiar el formulario
        document.querySelector('form').reset();
        // Limpiar las entradas adicionales
        ['education-container', 'experience-container', 'skills-container', 'references-container'].forEach(containerId => {
            const container = document.getElementById(containerId);
            if (container) {
                const entries = container.querySelectorAll('.education-entry, .experience-entry, .skill-entry, .reference-entry');
                // Mantener solo la primera entrada y limpiarla
                for (let i = 1; i < entries.length; i++) {
                    entries[i].remove();
                }
                if (entries.length > 0) {
                    clearInputs(entries[0]);
                }
            }
        });
        // Remover cualquier mensaje de error previo
        const errorDiv = form.querySelector('.bg-red-100');
        if (errorDiv) {
            errorDiv.remove();
        }
    }

    function goToDashboard() {
        window.location.href = '/dashboard';
    }

    function showImageCropper(input) {
        if (input.files && input.files[0]) {
            // Validar tamaño (1MB = 1048576 bytes)
            if (input.files[0].size > 1048576) {
                alert('La imagen no debe superar 1MB');
                input.value = '';
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                const modal = document.getElementById('cropperModal');
                const image = document.getElementById('cropperImage');
                image.src = e.target.result;
                modal.classList.remove('hidden');

                // Destruir cropper anterior si existe
                if (cropper) {
                    cropper.destroy();
                }

                // Inicializar Cropper.js
                cropper = new Cropper(image, {
                    aspectRatio: 1,
                    viewMode: 1,
                    dragMode: 'move',
                    cropBoxResizable: false,
                    cropBoxMovable: false,
                    minContainerWidth: 300,
                    minContainerHeight: 300,
                    guides: false,
                    center: true,
                    highlight: false,
                    background: false,
                    autoCropArea: 1,
                    responsive: true,
                    toggleDragModeOnDblclick: false
                });
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function cropImage() {
        if (cropper) {
            // Obtener el canvas recortado
            const canvas = cropper.getCroppedCanvas({
                width: 200,
                height: 200
            });

            // Convertir a base64
            croppedImageData = canvas.toDataURL('image/jpeg');
            
            // Actualizar la vista previa
            const preview = document.getElementById('photo-preview');
            preview.innerHTML = `
                <div class="w-20 h-20 overflow-hidden rounded-full">
                    <img src="${croppedImageData}" class="w-full h-full object-cover">
                </div>`;

            // Crear un nuevo archivo a partir del base64
            fetch(croppedImageData)
                .then(res => res.blob())
                .then(blob => {
                    const file = new File([blob], "profile-photo.jpg", { type: "image/jpeg" });
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(file);
                    document.getElementById('photo').files = dataTransfer.files;
                });

            // Cerrar el modal
            cancelCrop();
        }
    }

    function cancelCrop() {
        const modal = document.getElementById('cropperModal');
        modal.classList.add('hidden');
        if (cropper) {
            cropper.destroy();
            cropper = null;
        }
        if (!croppedImageData) {
            document.getElementById('photo').value = '';
        }
    }
</script>
@endsection
