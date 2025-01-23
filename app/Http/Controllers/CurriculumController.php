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
        $curriculums = Curriculum::all();
        return view('curriculums.index', compact('curriculums'));
    }

    public function create()
    {
        return view('curriculums.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'rut' => 'required|string|regex:/^\d{7,8}-[0-9Kk]$/|unique:curriculums,rut',
            'email' => 'required|email|unique:curriculums,email',
            'phone' => 'required|string|max:20',
            'civil_status' => 'required|string|in:Soltero(a),Casado(a),Divorciado(a),Viudo(a)',
            'profile_image' => 'nullable|url',
            'photo_file' => 'nullable|image|mimes:jpeg,png,gif|max:2048',
            'summary' => 'nullable|string',
        ]);
    
        // Procesar la imagen
        $photoPath = null;
        if ($request->hasFile('photo_file')) {
            $photoPath = $request->file('photo_file')->store('profiles', 'public');
        }
    
        // Crear el currículum
        $curriculum = Curriculum::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'rut' => $request->rut,
            'email' => $request->email,
            'phone' => $request->phone,
            'photo' => $photoPath,
            'summary' => $request->summary,
            'civil_status' => $request->civil_status,
        ]);
    
        // Guardar Formación Académica
        foreach ($request->institution as $key => $value) {
            $curriculum->educations()->create([
                'institution' => $request->institution[$key],
                'degree' => $request->degree[$key],
                'start_date' => $request->start_date[$key],
                'end_date' => $request->end_date[$key],
            ]);
        }
    
        // Guardar Experiencia Laboral
        foreach ($request->company as $key => $value) {
            $curriculum->experiences()->create([
                'company' => $request->company[$key],
                'position' => $request->position[$key],
                'job_start_date' => $request->job_start_date[$key],
                'job_end_date' => $request->job_end_date[$key],
                'description' => $request->job_description[$key] ?? null,
            ]);
        }
    
        // Generar PDF
        $pdf = Pdf::loadView('curriculums.pdf', compact('curriculum'));
        return $pdf->download('curriculum_' . $request->rut . '.pdf');
    }
    

    public function show($id)
    {
        $curriculum = Curriculum::findOrFail($id);
        return view('curriculums.show', compact('curriculum'));
    }

    public function destroy($id)
    {
        $curriculum = Curriculum::findOrFail($id);
        Storage::delete('public/' . $curriculum->profile_image);
        $curriculum->delete();
        return redirect()->route('curriculums.index');
    }
}
