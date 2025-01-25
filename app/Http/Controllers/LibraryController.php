<?php

namespace App\Http\Controllers;

use App\Models\Library;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class LibraryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = request('search');
        $query = Library::withCount('users');

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%'.$search.'%')
                  ->orWhere('address', 'like', '%'.$search.'%')
                  ->orWhere('email', 'like', '%'.$search.'%')
                  ->orWhere('phone', 'like', '%'.$search.'%');
            });
        }

        $libraries = $query->paginate(10)->withQueryString();
        return view('libraries.index', compact('libraries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('libraries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:libraries,email',
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            Library::create($validated);
            DB::commit();
            return redirect()->route('libraries.index')->with('success', 'Biblioteca creada exitosamente.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()->withErrors(['error' => 'Error al crear la biblioteca.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Library $library)
    {
        return view('libraries.edit', compact('library'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Library $library)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('libraries')->ignore($library->id)],
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            $library->update($validated);
            DB::commit();
            return redirect()->route('libraries.index')->with('success', 'Biblioteca actualizada exitosamente.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()->withErrors(['error' => 'Error al actualizar la biblioteca.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Library $library)
    {
        if ($library->users()->count() > 0) {
            return back()->withErrors(['error' => 'No se puede eliminar la biblioteca porque tiene usuarios asociados.']);
        }

        DB::beginTransaction();
        try {
            $library->delete();
            DB::commit();
            return redirect()->route('libraries.index')->with('success', 'Biblioteca eliminada exitosamente.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => 'Error al eliminar la biblioteca.']);
        }
    }

    /**
     * Busca bibliotecas por nombre, dirección o email
     */
    public function search(Request $request)
    {
        $search = $request->get('search');
        
        $libraries = Library::where('name', 'like', "%{$search}%")
            ->orWhere('address', 'like', "%{$search}%")
            ->orWhere('email', 'like', "%{$search}%")
            ->withCount('users')
            ->orderBy('name')
            ->paginate(10);

        if($request->ajax()) {
            return response()->json([
                'libraries' => $libraries,
                'links' => $libraries->links()->toHtml(),
            ]);
        }

        return view('libraries.index', compact('libraries', 'search'));
    }
}
