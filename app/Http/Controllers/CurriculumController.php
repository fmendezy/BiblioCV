<?php

namespace App\Http\Controllers;

use App\Models\Curriculum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class CurriculumController extends Controller
{
    public function index()
    {
        $curriculums = Curriculum::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(30);
        return view('curriculums.index', compact('curriculums'));
    }

    public function search(Request $request)
    {
        $query = $request->get('query');
        
        $curriculums = Curriculum::with('user')
            ->where('rut', 'LIKE', "%{$query}%")
            ->orWhere('name', 'LIKE', "%{$query}%")
            ->orWhereHas('user', function($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(30);

        if ($request->ajax()) {
            return response()->json([
                'html' => view('curriculums.partials.table', compact('curriculums'))->render(),
                'pagination' => $curriculums->links()->toHtml()
            ]);
        }

        return view('curriculums.index', compact('curriculums'));
    }

    public function create()
    {
        return view('curriculums.create');
    }

    public function store(Request $request)
    {
        try {
            \Log::info('Iniciando proceso de guardado de currículum');
            \Log::info('Datos recibidos:', $request->all());
            
            $messages = [
                'rut.required' => 'El RUT es obligatorio.',
                'name.required' => 'El nombre es obligatorio.',
                'name.min' => 'El nombre debe tener al menos 3 caracteres.',
                'email.required' => 'El correo electrónico es obligatorio.',
                'email.email' => 'El correo electrónico debe ser válido.',
                'phone.required' => 'El teléfono es obligatorio.',
                'phone.regex' => 'El teléfono debe tener un formato válido (+56912345678).',
                'birthdate.required' => 'La fecha de nacimiento es obligatoria.',
                'birthdate.date' => 'La fecha de nacimiento debe ser una fecha válida.',
                'birthdate.before' => 'Debes tener al menos 15 años para crear un currículum.',
                'marital_status.required' => 'El estado civil es obligatorio.',
                'marital_status.in' => 'El estado civil seleccionado no es válido.',
                'photo.image' => 'El archivo debe ser una imagen.',
                'photo.max' => 'La imagen no debe pesar más de 1MB.',
                'photo.mimes' => 'La imagen debe ser JPG o PNG.',
            ];

            $validated = $request->validate([
                'rut' => 'required',
                'name' => 'required|string|min:3|max:255',
                'birthdate' => ['required', 'date', 'before:' . now()->subYears(15)->format('Y-m-d')],
                'marital_status' => ['required', 'string', 'in:Soltero/a,Casado/a,Divorciado/a,Viudo/a,Conviviente Civil'],
                'email' => 'required|email',
                'phone' => ['required', 'regex:/^\+?56?\d{9}$/'],
                'photo' => 'nullable|image|max:1024',
                'job_title' => 'nullable|string|max:255',
                'profile_summary' => 'nullable|string',
                'summary' => 'nullable|string',
                
                // Validaciones para formación académica
                'institution.*' => ['required', 'string', 'max:255'],
                'degree.*' => ['required', 'string', 'max:255'],
                'education_start_date.*' => ['required', 'date'],
                'education_end_date.*' => ['required', 'date', 'after_or_equal:education_start_date.*'],
                
                // Validaciones para experiencia laboral
                'company.*' => ['required', 'string', 'max:255'],
                'position.*' => ['required', 'string', 'max:255'],
                'experience_start_date.*' => ['required', 'date'],
                'experience_end_date.*' => ['required', 'date', 'after_or_equal:experience_start_date.*'],
                'job_description.*' => ['nullable', 'string'],
                
                // Validaciones para habilidades
                'skills.*' => ['required', 'string', 'max:255'],
                
                // Validaciones para referencias
                'reference_name.*' => ['required', 'string', 'max:255'],
                'relation.*' => ['required', 'string', 'max:255'],
                'contact_info.*' => ['required', 'string', 'regex:/^\+?56?\d{9}$|^[^@]+@[^@]+\.[a-zA-Z]{2,}$/'],
            ], $messages);

            \Log::info('Validación exitosa');
            \DB::beginTransaction();
            
            // Procesar la foto si se subió una
            $photoPath = null;
            if ($request->hasFile('photo')) {
                $photo = $request->file('photo');
                if ($photo->isValid()) {
                    $photoPath = $photo->store('photos', 'public');
                    \Log::info('Foto guardada en:', ['path' => $photoPath]);
                } else {
                    \Log::error('La foto no es válida');
                }
            } else {
                \Log::info('No se subió ninguna foto');
            }
            
            // Crear el currículum
            $curriculum = Curriculum::create([
                'user_id' => Auth::id(),
                'rut' => $request->rut,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'photo' => $photoPath,
                'birthdate' => $request->birthdate,
                'marital_status' => $request->marital_status,
                'job_title' => $request->job_title,
                'profile_summary' => $request->profile_summary,
                'summary' => $request->summary,
            ]);
            
            \Log::info('Currículum base creado:', ['id' => $curriculum->id]);

            // Guardar formación académica
            if ($request->has('institution')) {
                foreach ($request->institution as $key => $value) {
                    $education = $curriculum->educations()->create([
                        'institution' => $request->institution[$key],
                        'degree' => $request->degree[$key],
                        'start_date' => $request->education_start_date[$key],
                        'end_date' => $request->education_end_date[$key],
                    ]);
                    \Log::info('Educación creada:', ['id' => $education->id]);
                }
            }

            // Guardar experiencia laboral
            if ($request->has('company')) {
                foreach ($request->company as $key => $value) {
                    $experience = $curriculum->experiences()->create([
                        'company' => $request->company[$key],
                        'position' => $request->position[$key],
                        'start_date' => $request->experience_start_date[$key],
                        'end_date' => $request->experience_end_date[$key],
                        'description' => $request->job_description[$key] ?? null,
                    ]);
                    \Log::info('Experiencia creada:', ['id' => $experience->id]);
                }
            }

            // Guardar habilidades
            if ($request->has('skills')) {
                foreach ($request->skills as $skill) {
                    $skillRecord = $curriculum->skills()->create(['name' => $skill]);
                    \Log::info('Habilidad creada:', ['id' => $skillRecord->id]);
                }
            }

            // Guardar referencias
            if ($request->has('reference_name')) {
                foreach ($request->reference_name as $key => $value) {
                    $reference = $curriculum->references()->create([
                        'name' => $request->reference_name[$key],
                        'relation' => $request->relation[$key],
                        'contact' => $request->contact_info[$key],
                    ]);
                    \Log::info('Referencia creada:', ['id' => $reference->id]);
                }
            }

            \DB::commit();
            \Log::info('Currículum guardado exitosamente');
            
            // Cargar las relaciones necesarias para la vista
            $curriculum->load(['educations', 'experiences', 'skills', 'references']);

            // Generar PDF desde la vista preview
            $pdf = PDF::loadView('curriculums.preview', compact('curriculum'));
            
            // Formatear la fecha actual
            $fecha = now()->format('d-m-Y');
            
            return response($pdf->output(), 200)
                ->header('Content-Type', 'application/pdf')
                ->header('Content-Disposition', 'attachment; filename="CV_'.strtoupper($curriculum->name).'_'.$fecha.'_'.$curriculum->id.'.pdf"')
                ->header('X-Success', 'true')
                ->header('X-Curriculum-Name', $curriculum->name);

        } catch (\Exception $e) {
            \DB::rollBack();
            \Log::error('Error al guardar el currículum: ' . $e->getMessage());
            \Log::error($e->getTraceAsString());
            
            if ($e instanceof \Illuminate\Validation\ValidationException) {
                return redirect()->back()
                    ->withErrors($e->errors())
                    ->withInput();
            }
            
            return redirect()->back()
                ->withErrors(['error' => 'Error al guardar el currículum: ' . $e->getMessage()])
                ->withInput();
        }
    }
    

    public function show(Curriculum $curriculum)
    {
        try {
            // Verificar que el usuario tenga permiso para ver este curriculum
            if (auth()->user()->role === 'user' && $curriculum->rut !== auth()->user()->rut) {
                abort(403, 'No tienes permiso para ver este currículum.');
            }

            // Cargar las relaciones necesarias para la vista
            $curriculum->load(['educations', 'experiences', 'skills', 'references']);

            // Generar PDF desde la vista preview
            $pdf = PDF::loadView('curriculums.preview', compact('curriculum'));
            
            // Formatear la fecha actual
            $fecha = now()->format('d-m-Y');
            
            // Usar el mismo formato de nombre que en create
            return response($pdf->output(), 200)
                ->header('Content-Type', 'application/pdf')
                ->header('Content-Disposition', 'attachment; filename="CV_'.strtoupper($curriculum->name).'_'.$fecha.'_'.$curriculum->id.'.pdf"');
        } catch (\Exception $e) {
            \Log::error('Error al generar PDF: ' . $e->getMessage());
            return back()->with('error', 'Error al generar el PDF. Por favor, intente nuevamente.');
        }
    }

    public function edit(Curriculum $curriculum)
    {
        // Cargar todas las relaciones necesarias
        $curriculum->load(['educations', 'experiences', 'skills', 'references']);
        
        // Asegurarse de que los datos estén disponibles en la vista
        return view('curriculums.edit', [
            'curriculum' => $curriculum,
            'educations' => $curriculum->educations,
            'experiences' => $curriculum->experiences,
            'skills' => $curriculum->skills,
            'references' => $curriculum->references
        ]);
    }

    public function update(Request $request, Curriculum $curriculum)
    {
        try {
            \Log::info('Iniciando actualización de currículum');
            
            $validated = $request->validate([
                'rut' => 'required',
                'name' => 'required|string|min:3|max:255',
                'birthdate' => ['required', 'date', 'before:' . now()->subYears(15)->format('Y-m-d')],
                'marital_status' => ['required', 'string', 'in:Soltero/a,Casado/a,Divorciado/a,Viudo/a,Conviviente Civil'],
                'email' => 'required|email',
                'phone' => ['required', 'regex:/^\+?56?\d{9}$/'],
                'photo' => 'nullable|image|max:1024',
                'job_title' => 'required|string|max:255',
                'profile_summary' => 'required|string',
                
                // Validaciones para formación académica
                'institution.*' => ['required', 'string', 'max:255'],
                'degree.*' => ['required', 'string', 'max:255'],
                'education_start_date.*' => ['required', 'date'],
                'education_end_date.*' => ['required', 'date', 'after_or_equal:education_start_date.*'],
                
                // Validaciones para experiencia laboral
                'company.*' => ['required', 'string', 'max:255'],
                'position.*' => ['required', 'string', 'max:255'],
                'experience_start_date.*' => ['required', 'date'],
                'experience_end_date.*' => ['required', 'date', 'after_or_equal:experience_start_date.*'],
                'job_description.*' => ['nullable', 'string'],
                
                // Validaciones para habilidades
                'skills.*' => ['required', 'string', 'max:255'],
                
                // Validaciones para referencias
                'reference_name.*' => ['required', 'string', 'max:255'],
                'relation.*' => ['required', 'string', 'max:255'],
                'contact_info.*' => ['required', 'string', 'regex:/^\+?56?\d{9}$|^[^@]+@[^@]+\.[a-zA-Z]{2,}$/'],
            ]);

            \DB::beginTransaction();

            // Procesar la foto si se subió una nueva
            if ($request->hasFile('photo')) {
                $photo = $request->file('photo');
                if ($photo->isValid()) {
                    // Eliminar la foto anterior si existe
                    if ($curriculum->photo && Storage::disk('public')->exists($curriculum->photo)) {
                        Storage::disk('public')->delete($curriculum->photo);
                    }
                    $photoPath = $photo->store('photos', 'public');
                    $validated['photo'] = $photoPath;
                }
            }

            // Actualizar datos básicos del currículum
            $curriculum->update([
                'rut' => $request->rut,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'photo' => $validated['photo'] ?? $curriculum->photo,
                'birthdate' => $request->birthdate,
                'marital_status' => $request->marital_status,
                'job_title' => $request->job_title,
                'profile_summary' => $request->profile_summary
            ]);

            // Actualizar educación académica
            $curriculum->educations()->delete();
            if ($request->has('institution')) {
                foreach ($request->institution as $key => $value) {
                    $curriculum->educations()->create([
                        'institution' => $request->institution[$key],
                        'degree' => $request->degree[$key],
                        'start_date' => $request->education_start_date[$key],
                        'end_date' => $request->education_end_date[$key],
                    ]);
                }
            }

            // Actualizar experiencia laboral
            $curriculum->experiences()->delete();
            if ($request->has('company')) {
                foreach ($request->company as $key => $value) {
                    $curriculum->experiences()->create([
                        'company' => $request->company[$key],
                        'position' => $request->position[$key],
                        'start_date' => $request->experience_start_date[$key],
                        'end_date' => $request->experience_end_date[$key],
                        'description' => $request->job_description[$key] ?? null,
                    ]);
                }
            }

            // Actualizar habilidades
            $curriculum->skills()->delete();
            if ($request->has('skills')) {
                foreach ($request->skills as $skill) {
                    if (!empty($skill)) {
                        $curriculum->skills()->create(['name' => $skill]);
                    }
                }
            }

            // Actualizar referencias
            $curriculum->references()->delete();
            if ($request->has('reference_name')) {
                foreach ($request->reference_name as $key => $value) {
                    $curriculum->references()->create([
                        'name' => $request->reference_name[$key],
                        'relation' => $request->relation[$key],
                        'contact' => $request->contact_info[$key],
                    ]);
                }
            }

            \DB::commit();
            return redirect()->route('curriculums.index')
                ->with('success', 'Currículum actualizado exitosamente.');
            
        } catch (\Exception $e) {
            \DB::rollBack();
            \Log::error('Error al actualizar curriculum: ' . $e->getMessage());
            return back()
                ->withErrors(['error' => 'Error al actualizar el currículum: ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function destroy($id)
    {
        $curriculum = Curriculum::findOrFail($id);
        Storage::delete('public/' . $curriculum->profile_image);
        $curriculum->delete();
        return redirect()->route('curriculums.index');
    }

    public function myCurriculums()
    {
        $curriculums = Curriculum::where('rut', auth()->user()->rut)
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('curriculums.my-curriculums', compact('curriculums'));
    }
}
