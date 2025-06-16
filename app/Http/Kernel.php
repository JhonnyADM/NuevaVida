<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * Global HTTP middleware stack.
     * These middleware are run during every request.
     *
     * @var array<int, class-string|string>
     */
    protected $middleware = [
        // aquí van los middleware globales, puedes dejar vacío si quieres
        // ejemplo: \App\Http\Middleware\TrustProxies::class,
    ];

    /**
     * Route middleware groups.
     *
     * @var array<string, array<int, class-string|string>>
     */
    protected $middlewareGroups = [
        'web' => [
            // middleware que normalmente se usan para rutas web

        ],

        'api' => [
            // middleware para rutas API
            'throttle:api',

        ],
    ];

    /**
     * Route middleware.
     * Estos middleware se pueden asignar por alias a las rutas.
     *
     * @var array<string, class-string|string>
     */
    protected $routeMiddleware = [
        'VerificarRol' => \App\Http\Middleware\VerificarRol::class,
    ];
}
