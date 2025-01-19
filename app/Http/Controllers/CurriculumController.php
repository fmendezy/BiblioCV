<?php

namespace App\Http\Controllers;

use App\Models\Curriculum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CurriculumController extends Controller
{
    // Mostrar todos los currículums
    public function index()
    {
        $curriculums = Curriculum::all();
        return view('curriculums.index', compact('curriculums'));
    }

    // Mostrar el formulario para crear un nuevo currículum
    public function create()
    {
        return view('curriculums.create');
    }

    // Guardar un nuevo currículum
    public function store(Request $request)
    {
        // Validación de los datos
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'rut' => ['required', 'string', 'regex:/^(\d{1,2})\.(\d{3})\.(\d{3})\-([0-9Kk])$/', 'unique:curriculums,rut'], // Validación de RUT chileno
            'dob' => 'required|date',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|unique:curriculums,email',
            'civil_status' => 'required|string|in:Soltero(a),Casado(a),Divorciado(a),Viudo(a)', // Opciones para estado civil
            'photo' => 'nullable|url', // Foto opcional
            'degree' => 'required|string|max:255',
            'institution' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
            'courses' => 'nullable|string',
            'company' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'job_start_date' => 'required|date',
            'job_end_date' => 'nullable|date|after:job_start_date',
            'job_description' => 'nullable|string',
            'references' => 'nullable|string',
            'skills' => 'nullable|string',
            'languages' => 'nullable|string',
            'salary_expectation' => 'nullable|numeric|min:0', // Expectativa de sueldo en pesos chilenos
            'available' => 'nullable|boolean', // Disponibilidad
            'personal_references' => 'nullable|string',
        ]);

        // Si la validación falla, redirigir con los errores
        if ($validator->fails()) {
            return redirect()->route('curriculums.create')
                             ->withErrors($validator)
                             ->withInput();
        }

        // Limpiar y asegurarse de que la expectativa de sueldo esté en el formato correcto
        $salaryExpectation = $request->has('salary_expectation') ? str_replace('.', '', $request->salary_expectation) : null;

        // Asegurarse de que el valor no sea demasiado grande
        $salaryExpectation = min($salaryExpectation, 9999999999);  // Establecer un límite máximo si es necesario

        // Crear el nuevo currículum
        Curriculum::create([
            'name' => $request->name,
            'rut' => $request->rut,
            'dob' => $request->dob,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'civil_status' => $request->civil_status,
            'photo' => $request->photo,
            'degree' => $request->degree,
            'institution' => $request->institution,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'courses' => $request->courses,
            'company' => $request->company,
            'position' => $request->position,
            'job_start_date' => $request->job_start_date,
            'job_end_date' => $request->job_end_date,
            'job_description' => $request->job_description,
            'references' => $request->references,
            'skills' => $request->skills,
            'languages' => $request->languages,
            'salary_expectation' => $salaryExpectation,  // Guardar el sueldo como número entero sin decimales
            'available' => $request->has('available') ? true : false,  // Convertir disponibilidad a booleano
            'personal_references' => $request->personal_references,
        ]);

        return redirect()->route('curriculums.index');
    }

    // Mostrar un currículum específico
    public function show($id)
    {
        $curriculum = Curriculum::findOrFail($id);
        return view('curriculums.show', compact('curriculum'));
    }

    // Mostrar el formulario para editar un currículum
    public function edit($id)
    {
        $curriculum = Curriculum::findOrFail($id);
        return view('curriculums.edit', compact('curriculum'));
    }

    // Actualizar un currículum existente
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'rut' => ['required', 'string', 'regex:/^(\d{1,2})\.(\d{3})\.(\d{3})\-([0-9Kk])$/', 'unique:curriculums,rut,' . $id],
            'dob' => 'required|date',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|unique:curriculums,email,' . $id,
            'civil_status' => 'required|string|in:Soltero(a),Casado(a),Divorciado(a),Viudo(a)',
            'photo' => 'nullable|url',
            'degree' => 'required|string|max:255',
            'institution' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
            'courses' => 'nullable|string',
            'company' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'job_start_date' => 'required|date',
            'job_end_date' => 'nullable|date|after:job_start_date',
            'job_description' => 'nullable|string',
            'references' => 'nullable|string',
            'skills' => 'nullable|string',
            'languages' => 'nullable|string',
            'salary_expectation' => 'nullable|numeric|min:0',
            'available' => 'nullable|boolean',
            'personal_references' => 'nullable|string',
        ]);

        // Limpiar y asegurarse de que la expectativa de sueldo esté en el formato correcto
        $salaryExpectation = $request->has('salary_expectation') ? str_replace('.', '', $request->salary_expectation) : null;

        // Asegurarse de que el valor no sea demasiado grande
        $salaryExpectation = min($salaryExpectation, 9999999999);  // Establecer un límite máximo si es necesario

        $curriculum = Curriculum::findOrFail($id);
        $curriculum->update([
            'name' => $request->name,
            'rut' => $request->rut,
            'dob' => $request->dob,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'civil_status' => $request->civil_status,
            'photo' => $request->photo,
            'degree' => $request->degree,
            'institution' => $request->institution,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'courses' => $request->courses,
            'company' => $request->company,
            'position' => $request->position,
            'job_start_date' => $request->job_start_date,
            'job_end_date' => $request->job_end_date,
            'job_description' => $request->job_description,
            'references' => $request->references,
            'skills' => $request->skills,
            'languages' => $request->languages,
            'salary_expectation' => $salaryExpectation,  // Guardar el sueldo como número entero sin decimales
            'available' => $request->has('available') ? true : false,  // Convertir disponibilidad a booleano
            'personal_references' => $request->personal_references,
        ]);

        return redirect()->route('curriculums.index');
    }

    // Eliminar un currículum
    public function destroy($id)
    {
        $curriculum = Curriculum::findOrFail($id);
        $curriculum->delete();

        return redirect()->route('curriculums.index');
    }
}
