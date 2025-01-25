<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Library;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Validation\Rule;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $libraries = Library::all();
        return view('auth.register', compact('libraries'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'min:3',
                'max:255',
                'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/',
            ],
            'email' => [
                'required',
                'string',
                'email:rfc,dns',
                'max:255',
                'unique:users',
                'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'
            ],
            'password' => [
                'required',
                'string',
                'min:6',
                'max:50',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'
            ],
            'rut' => [
                'required',
                'string',
                'regex:/^\d{7,8}[-][0-9kK]{1}$/',
                'unique:users'
            ],
            'role' => [
                'required',
                'string',
                Rule::in(['admin', 'employee', 'user'])
            ],
            'library_id' => [
                'required',
                'integer',
                'exists:libraries,id'
            ],
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'name.min' => 'El nombre debe tener al menos 3 caracteres.',
            'name.regex' => 'El nombre solo puede contener letras y espacios.',
            
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser una dirección válida.',
            'email.unique' => 'Este correo electrónico ya está registrado.',
            'email.regex' => 'El formato del correo electrónico no es válido.',
            
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
            'password.regex' => 'La contraseña debe contener al menos una letra minúscula, una mayúscula y un número.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            
            'rut.required' => 'El RUT es obligatorio.',
            'rut.regex' => 'El RUT debe tener el formato: 11223344-5',
            'rut.unique' => 'Este RUT ya está registrado.',
            
            'role.required' => 'El tipo de cuenta es obligatorio.',
            'role.in' => 'El tipo de cuenta seleccionado no es válido.',
            
            'library_id.required' => 'La biblioteca es obligatoria.',
            'library_id.exists' => 'La biblioteca seleccionada no es válida.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rut' => $request->rut,
            'role' => $request->role,
            'library_id' => $request->library_id,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    // Formatear el RUT antes de guardarlo en la base de datos
    private function formatRut($rut)
    {
        return strtoupper(str_replace('.', '', trim($rut)));
    }
}
