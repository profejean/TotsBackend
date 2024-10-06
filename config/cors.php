<?php

return [

    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['*'], // Permitir todos los métodos HTTP

    'allowed_origins' => ['http://localhost:4200'], // Permitir solo las solicitudes desde tu frontend local de Angular

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'], // Permitir todas las cabeceras

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true, // Esto es importante para que se envíen las cookies de sesión con Sanctum

];
