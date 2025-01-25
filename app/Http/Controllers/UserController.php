<?php
 //Controlador Completo de Usuarios (CRUD)

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Library;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // Mostrar todos los usuarios
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $users = User::query()
            ->when($search, function ($query, $search) {
                $query->where(function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('rut', 'like', "%{$search}%")
                      ->orWhereHas('library', function($q) use ($search) {
                          $q->where('name', 'like', "%{$search}%");
                      });
                });
            })
            ->with('library')
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('users.index', compact('users'));
    }

    // Mostrar el formulario para crear un nuevo usuario
    public function create()
    {
        $libraries = Library::all();
        return view('users.create', compact('libraries'));
    }

    // Guardar un nuevo usuario
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'rut' => ['required', 'string', 'regex:/^\d{7,8}[-][0-9kK]{1}$/'],
            'role' => ['required', 'string', Rule::in(['admin', 'employee', 'user'])],
            'library_id' => 'required|exists:libraries,id',
        ], [
            'rut.regex' => 'El RUT debe tener el formato: 11223344-5',
            'role.in' => 'El rol debe ser: Administrador, Funcionario o Usuario',
            'library_id.required' => 'Debe seleccionar una biblioteca',
            'library_id.exists' => 'La biblioteca seleccionada no existe',
        ]);

        DB::beginTransaction();
        try {
            $validated['password'] = Hash::make($validated['password']);
            User::create($validated);
            DB::commit();
            return redirect()->route('users.index')->with('success', 'Usuario creado exitosamente.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()->withErrors(['error' => 'Error al crear el usuario.']);
        }
    }

    // Mostrar un usuario específico
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    // Mostrar el formulario para editar un usuario
    public function edit(User $user)
    {
        $libraries = Library::all();
        return view('users.edit', compact('user', 'libraries'));
    }

    // Actualizar un usuario específico
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:8|confirmed',
            'rut' => ['required', 'string', 'regex:/^\d{7,8}[-][0-9kK]{1}$/'],
            'role' => ['required', 'string', Rule::in(['admin', 'employee', 'user'])],
            'library_id' => 'required|exists:libraries,id',
        ], [
            'rut.regex' => 'El RUT debe tener el formato: 11223344-5',
            'role.in' => 'El rol debe ser: Administrador, Funcionario o Usuario',
            'library_id.required' => 'Debe seleccionar una biblioteca',
            'library_id.exists' => 'La biblioteca seleccionada no existe',
        ]);

        DB::beginTransaction();
        try {
            if ($request->filled('password')) {
                $validated['password'] = Hash::make($validated['password']);
            } else {
                unset($validated['password']);
            }
            
            $user->update($validated);
            DB::commit();
            return redirect()->route('users.index')->with('success', 'Usuario actualizado exitosamente.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()->withErrors(['error' => 'Error al actualizar el usuario.']);
        }
    }

    // Eliminar un usuario
    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->withErrors(['error' => 'No puedes eliminar tu propio usuario.']);
        }

        DB::beginTransaction();
        try {
            $user->delete();
            DB::commit();
            return redirect()->route('users.index')->with('success', 'Usuario eliminado exitosamente.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => 'Error al eliminar el usuario.']);
        }
    }

    /**
     * Busca usuarios por nombre, email o RUT
     */
    public function search(Request $request)
    {
        $search = $request->get('search');
        
        $users = User::where('name', 'like', "%{$search}%")
            ->orWhere('email', 'like', "%{$search}%")
            ->orWhere('rut', 'like', "%{$search}%")
            ->with('library')
            ->orderBy('name')
            ->paginate(10);

        if($request->ajax()) {
            return response()->json([
                'users' => $users,
                'links' => $users->links()->toHtml(),
            ]);
        }

        return view('users.index', compact('users', 'search'));
    }
}
