<?php

return [
    'required' => 'El campo :attribute es obligatorio.',
    'string' => 'El campo :attribute debe ser texto.',
    'email' => 'El campo :attribute debe ser una dirección de correo válida.',
    'unique' => 'El valor ingresado para :attribute ya está en uso.',
    'min' => [
        'string' => 'El campo :attribute debe tener al menos :min caracteres.',
    ],
    'max' => [
        'string' => 'El campo :attribute no puede tener más de :max caracteres.',
    ],
    'confirmed' => 'La confirmación de :attribute no coincide.',
    'regex' => 'El formato de :attribute no es válido.',
    'exists' => 'El :attribute seleccionado no es válido.',
    'in' => 'El :attribute seleccionado no es válido.',

    'attributes' => [
        'name' => 'nombre',
        'email' => 'correo electrónico',
        'password' => 'contraseña',
        'rut' => 'RUT',
        'role' => 'tipo de cuenta',
        'library_id' => 'biblioteca',
        'phone' => 'teléfono',
        'address' => 'dirección',
    ],
]; 