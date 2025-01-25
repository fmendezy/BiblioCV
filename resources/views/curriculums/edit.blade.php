@extends('layouts.app')

@section('content')
<!-- Agregar CSS de Cropper.js en el head -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css">

<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6 mb-16">
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold">Editar Currículum</h2>
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

        <form action="{{ route('curriculums.update', $curriculum) }}" method="POST" enctype="multipart/form-data" id="curriculumForm">
            @csrf
            @method('PUT')

            <!-- Información Personal -->
            <div class="mb-8">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Información Personal</h3>
                <div class="space-y-4">
                    <div>
                        <label for="rut" class="block text-sm font-medium text-gray-700">RUT</label>
                        <input type="text" name="rut" id="rut" value="{{ old('rut', $curriculum->rut) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nombre Completo</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $curriculum->name) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Correo Electrónico</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $curriculum->email) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700">Teléfono</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone', $curriculum->phone) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div>
                        <label for="birthdate" class="block text-sm font-medium text-gray-700">Fecha de Nacimiento</label>
                        <input type="date" name="birthdate" id="birthdate" value="{{ old('birthdate', $curriculum->birthdate) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div>
                        <label for="marital_status" class="block text-sm font-medium text-gray-700">Estado Civil</label>
                        <select name="marital_status" id="marital_status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="Soltero/a" {{ old('marital_status', $curriculum->marital_status) == 'Soltero/a' ? 'selected' : '' }}>Soltero/a</option>
                            <option value="Casado/a" {{ old('marital_status', $curriculum->marital_status) == 'Casado/a' ? 'selected' : '' }}>Casado/a</option>
                            <option value="Divorciado/a" {{ old('marital_status', $curriculum->marital_status) == 'Divorciado/a' ? 'selected' : '' }}>Divorciado/a</option>
                            <option value="Viudo/a" {{ old('marital_status', $curriculum->marital_status) == 'Viudo/a' ? 'selected' : '' }}>Viudo/a</option>
                            <option value="Conviviente Civil" {{ old('marital_status', $curriculum->marital_status) == 'Conviviente Civil' ? 'selected' : '' }}>Conviviente Civil</option>
                        </select>
                    </div>

                    <div>
                        <label for="photo" class="block text-sm font-medium text-gray-700">Foto de Perfil</label>
                        <input type="file" name="photo" id="photo" accept="image/*" class="mt-1 block w-full" onchange="showImageCropper(this)">
                        @if($curriculum->photo)
                            <div class="mt-2">
                                <img src="{{ Storage::url($curriculum->photo) }}" alt="Foto actual" class="h-20 w-20 object-cover rounded-full">
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Información Profesional -->
            <div class="mb-8">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Información Profesional</h3>
                <div class="space-y-4">
                    <div>
                        <label for="job_title" class="block text-sm font-medium text-gray-700">Título o Profesión</label>
                        <input type="text" name="job_title" id="job_title" value="{{ old('job_title', $curriculum->job_title) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div>
                        <label for="profile_summary" class="block text-sm font-medium text-gray-700">Resumen Profesional</label>
                        <textarea name="profile_summary" id="profile_summary" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('profile_summary', $curriculum->profile_summary) }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Educación -->
            <div class="mb-8">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Educación</h3>
                <div id="education-container">
                    @forelse($curriculum->educations as $education)
                    <div class="education-entry bg-gray-50 p-4 rounded-lg mb-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Institución</label>
                                <input type="text" name="institution[]" value="{{ old('institution.'.$loop->index, $education->institution) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Título/Grado</label>
                                <input type="text" name="degree[]" value="{{ old('degree.'.$loop->index, $education->degree) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Fecha de Inicio</label>
                                <input type="date" name="education_start_date[]" value="{{ old('education_start_date.'.$loop->index, $education->start_date) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Fecha de Término</label>
                                <input type="date" name="education_end_date[]" value="{{ old('education_end_date.'.$loop->index, $education->end_date) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="education-entry bg-gray-50 p-4 rounded-lg mb-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Institución</label>
                                <input type="text" name="institution[]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Título/Grado</label>
                                <input type="text" name="degree[]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Fecha de Inicio</label>
                                <input type="date" name="education_start_date[]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Fecha de Término</label>
                                <input type="date" name="education_end_date[]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                        </div>
                    </div>
                    @endforelse
                </div>
                <button type="button" onclick="addEducation()" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Agregar Educación
                </button>
            </div>

            <!-- Experiencia Laboral -->
            <div class="mb-8">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Experiencia Laboral</h3>
                <div id="experience-container">
                    @forelse($curriculum->experiences as $experience)
                    <div class="experience-entry bg-gray-50 p-4 rounded-lg mb-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Empresa</label>
                                <input type="text" name="company[]" value="{{ old('company.'.$loop->index, $experience->company) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Cargo</label>
                                <input type="text" name="position[]" value="{{ old('position.'.$loop->index, $experience->position) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Fecha de Inicio</label>
                                <input type="date" name="experience_start_date[]" value="{{ old('experience_start_date.'.$loop->index, $experience->start_date) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Fecha de Término</label>
                                <input type="date" name="experience_end_date[]" value="{{ old('experience_end_date.'.$loop->index, $experience->end_date) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700">Descripción del Cargo</label>
                                <textarea name="job_description[]" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('job_description.'.$loop->index, $experience->description) }}</textarea>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="experience-entry bg-gray-50 p-4 rounded-lg mb-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Empresa</label>
                                <input type="text" name="company[]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Cargo</label>
                                <input type="text" name="position[]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Fecha de Inicio</label>
                                <input type="date" name="experience_start_date[]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Fecha de Término</label>
                                <input type="date" name="experience_end_date[]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700">Descripción del Cargo</label>
                                <textarea name="job_description[]" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                            </div>
                        </div>
                    </div>
                    @endforelse
                </div>
                <button type="button" onclick="addExperience()" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Agregar Experiencia
                </button>
            </div>

            <!-- Habilidades -->
            <div class="mb-8">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Habilidades</h3>
                <div id="skills-container">
                    @forelse($curriculum->skills as $skill)
                    <div class="skill-entry mb-2">
                        <input type="text" name="skills[]" value="{{ old('skills.'.$loop->index, $skill->name) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Ingrese una habilidad">
                    </div>
                    @empty
                    <div class="skill-entry mb-2">
                        <input type="text" name="skills[]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Ingrese una habilidad">
                    </div>
                    @endforelse
                </div>
                <button type="button" onclick="addSkill()" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Agregar Habilidad
                </button>
            </div>

            <!-- Referencias -->
            <div class="mb-8">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Referencias</h3>
                <div id="references-container">
                    @forelse($curriculum->references as $reference)
                    <div class="reference-entry bg-gray-50 p-4 rounded-lg mb-4">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nombre</label>
                                <input type="text" name="reference_name[]" value="{{ old('reference_name.'.$loop->index, $reference->name) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Relación</label>
                                <input type="text" name="relation[]" value="{{ old('relation.'.$loop->index, $reference->relation) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Contacto</label>
                                <input type="text" name="contact_info[]" value="{{ old('contact_info.'.$loop->index, $reference->contact) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="reference-entry bg-gray-50 p-4 rounded-lg mb-4">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nombre</label>
                                <input type="text" name="reference_name[]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Relación</label>
                                <input type="text" name="relation[]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Contacto</label>
                                <input type="text" name="contact_info[]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                        </div>
                    </div>
                    @endforelse
                </div>
                <button type="button" onclick="addReference()" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Agregar Referencia
                </button>
            </div>

            <div class="flex items-center justify-end mt-6 space-x-8">
                <button type="button" onclick="window.location.href='{{ route('curriculums.index') }}'" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Cancelar
                </button>
                <button type="submit" name="action" value="save" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Guardar
                </button>
            </div>
        </form>
    </div>
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

@push('scripts')
<!-- Agregar script de Cropper.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>

<script>
    let cropper = null;
    let croppedImageData = null;

    function showImageCropper(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const modal = document.getElementById('cropperModal');
                const image = document.getElementById('cropperImage');
                image.src = e.target.result;
                
                modal.classList.remove('hidden');
                
                if (cropper) {
                    cropper.destroy();
                }
                
                cropper = new Cropper(image, {
                    aspectRatio: 1,
                    viewMode: 1,
                    autoCropArea: 1,
                });
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function cancelCrop() {
        const modal = document.getElementById('cropperModal');
        modal.classList.add('hidden');
        document.getElementById('photo').value = '';
        if (cropper) {
            cropper.destroy();
            cropper = null;
        }
    }

    function cropImage() {
        if (cropper) {
            const canvas = cropper.getCroppedCanvas({
                width: 300,
                height: 300
            });
            
            croppedImageData = canvas.toDataURL();
            
            // Actualizar la vista previa
            const preview = document.getElementById('photo-preview');
            preview.innerHTML = `<img src="${croppedImageData}" alt="Foto recortada" class="h-full w-full object-cover">`;
            
            // Convertir la imagen recortada a un archivo
            canvas.toBlob(function(blob) {
                const file = new File([blob], 'photo.jpg', { type: 'image/jpeg' });
                const container = new DataTransfer();
                container.items.add(file);
                document.getElementById('photo').files = container.files;
            }, 'image/jpeg');
            
            // Cerrar el modal
            const modal = document.getElementById('cropperModal');
            modal.classList.add('hidden');
            cropper.destroy();
            cropper = null;
        }
    }

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
</script>
@endpush

@endsection