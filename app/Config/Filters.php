<?php

namespace Config;

use CodeIgniter\Config\Filters as BaseFilters;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\SecureHeaders;
use App\Filters\Cors; // ✅ Import Cors Filter

class Filters extends BaseFilters
{
    public array $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        'cors' => \Fluent\Cors\Filters\CorsFilter::class,
    ];

    public array $required = [
        'before' => [],
        'after' => [
            'toolbar',
            'secureheaders',
        ],
    ];

    public array $globals = [
        'before' => [
            'cors', // ✅ Enable CORS globally
        ],
        'after' => [
            'toolbar',
        ],
    ];

    public array $methods = [];

    public array $filters = [
        // ...
    'cors' => [
        'before' => ['api/*'],
        'after' => ['api/*']
    ],
    ];
}

