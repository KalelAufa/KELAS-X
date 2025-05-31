<?php

return [
    'paths' => ['api/*', '*'], // Paths that should accept CORS
    'allowed_methods' => ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'],

    // Development settings (React Vite default port)
    'allowed_origins' => [
        'http://localhost:5173', // React/Vite default port
        'http://127.0.0.1:5173',
    ],

    // Production example (uncomment when deploying)
    // 'allowed_origins' => [
    //     'https://yourdomain.com',
    //     'https://www.yourdomain.com'
    // ],

    'allowed_origins_patterns' => [],
    'allowed_headers' => [
        'Content-Type',
        'Authorization',
        'X-Requested-With',
        'X-CSRF-TOKEN'
    ],
    'exposed_headers' => [
        'Authorization',
        'X-RateLimit-Limit',
        'X-RateLimit-Remaining'
    ],
    'max_age' => 86400, // 24 hours for preflight cache
    'supports_credentials' => false, // Set true if using cookies/auth
];
