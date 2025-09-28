<?php

return [
    'paths' => ['api/*', 'login', 'logout', 'register'],
    'allowed_methods' => ['*'],
    'allowed_origins' => ['http://localhost:5173'], // frontend
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'],
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => true, // essencial para enviar cookies
];