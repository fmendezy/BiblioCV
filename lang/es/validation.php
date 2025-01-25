<?php

return [
    'unique' => 'El :attribute ya ha sido registrado.',
    'attributes' => [
        'rut' => 'RUT',
        'email' => 'correo electrónico',
        'phone' => 'teléfono',
    ],
    'custom' => [
        'rut' => [
            'unique' => 'Este RUT ya está registrado en el sistema.',
        ],
        'email' => [
            'unique' => 'Este correo electrónico ya está registrado en el sistema.',
        ],
    ],
]; 