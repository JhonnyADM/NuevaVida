<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For detailed instructions you can look the title section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'title' => 'Nueva Vida',
    'title_prefix' => '',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For detailed instructions you can look the favicon section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_ico_only' => false,
    'use_full_favicon' => false,

    /*
    |--------------------------------------------------------------------------
    | Google Fonts
    |--------------------------------------------------------------------------
    |
    | Here you can allow or not the use of external google fonts. Disabling the
    | google fonts may be useful if your admin panel internet access is
    | restricted somehow.
    |
    | For detailed instructions you can look the google fonts section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'google_fonts' => [
        'allowed' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For detailed instructions you can look the logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'logo' => '<b>Vida</b>Nueva',
    'logo_img' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
    'logo_img_class' => 'brand-image img-circle elevation-3',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'Admin Logo',

    /*
    |--------------------------------------------------------------------------
    | Authentication Logo
    |--------------------------------------------------------------------------
    |
    | Here you can setup an alternative logo to use on your login and register
    | screens. When disabled, the admin panel logo will be used instead.
    |
    | For detailed instructions you can look the auth logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'auth_logo' => [
        'enabled' => false,
        'img' => [
            'path' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
            'alt' => 'Auth Logo',
            'class' => '',
            'width' => 50,
            'height' => 50,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Preloader Animation
    |--------------------------------------------------------------------------
    |
    | Here you can change the preloader animation configuration. Currently, two
    | modes are supported: 'fullscreen' for a fullscreen preloader animation
    | and 'cwrapper' to attach the preloader animation into the content-wrapper
    | element and avoid overlapping it with the sidebars and the top navbar.
    |
    | For detailed instructions you can look the preloader section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'preloader' => [
        'enabled' => true,
        'mode' => 'fullscreen',
        'img' => [
            'path' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
            'alt' => 'AdminLTE Preloader Image',
            'effect' => 'animation__shake',
            'width' => 60,
            'height' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For detailed instructions you can look the user menu section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'usermenu_enabled' => true,
    'usermenu_header' => true,
    'usermenu_header_class' => 'bg-primary',
    'usermenu_image' => false,
    'usermenu_desc' => true,
    'usermenu_profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For detailed instructions you can look the layout section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => null,
    'layout_fixed_navbar' => null,
    'layout_fixed_footer' => null,
    'layout_dark_mode' => null,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For detailed instructions you can look the auth classes section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_auth_card' => 'card-outline card-primary',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-primary',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For detailed instructions you can look the admin panel classes here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-primary elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-white navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For detailed instructions you can look the sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'sidebar_mini' => 'lg',
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For detailed instructions you can look the right sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For detailed instructions you can look the urls section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_route_url' => false,
    'dashboard_url' => 'panel',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => 'register',
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
    'profile_url' => false,
    'disable_darkmode_routes' => false,

    /*
    |--------------------------------------------------------------------------
    | Laravel Asset Bundling
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Asset Bundling option for the admin panel.
    | Currently, the next modes are supported: 'mix', 'vite' and 'vite_js_only'.
    | When using 'vite_js_only', it's expected that your CSS is imported using
    | JavaScript. Typically, in your application's 'resources/js/app.js' file.
    | If you are not using any of these, leave it as 'false'.
    |
    | For detailed instructions you can look the asset bundling section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'laravel_asset_bundling' => false,
    'laravel_css_path' => 'css/app.css',
    'laravel_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */


        // Navbar items:
        [
            'type' => 'navbar-search',
            'text' => 'search',
            'topnav_right' => true,
        ],


        // Sidebar items:
        [
            'type' => 'sidebar-menu-search',
            'text' => 'search',
        ],
        [
            'text' => 'blog',
            'url' => 'admin/blog',
            'can' => 'manage-blog',
        ],


        [
            'text' => 'Gestión de Roles y Permisos',
            'url'  => 'roles',
            'icon' => 'fas fa-user-shield', // Ícono representativo para roles/permisos
        ],


        [
            'text' => 'GESTIÓN DE PERSONAL',
            'icon' => 'fas fa-users-cog',

            'submenu' => [
                [
                    'text' => 'Registro Personal',
                    'icon' => 'fas fa-users',
                    'url'  => 'personal',
                ],
                [
                    'text' => 'Gestión Personal Médico',
                    'icon' => 'fas fa-user-md',
                    'url'  => 'medico',
                ],
                [
                    'text' => 'Gestión Especialidad Médica',
                    'icon' => 'fas fa-stethoscope',
                    'url'  => 'especialidad',
                ],

                [
                    'text' => 'Gestión Personal Atención',
                    'icon' => 'fas fa-headset',
                    'url' => 'atencion',
                ],

                [
                    'text' => 'Gestión Personal Pasante',
                    'icon' => 'fas fa-user-graduate',
                    'url'  => 'pasante',
                ],

                [
                    'text' => 'Gestión Personal Voluntario',
                    'icon' => 'fas fa-hands-helping',
                    'url'  => 'voluntario',
                ],

                [
                    'text' => 'Gestión Personal Cliente',
                    'icon' => 'fas fa-user',
                    'url'  => 'cliente',
                ],
                [
                    'text' => 'Gestión de Areas de trabajo',
                    'icon' => 'fas fa-area',
                    'url'  => 'area',
                ],
                [
                    'text' => 'Gestión de Turnos de trabajo',
                    'icon' => 'fas fa-turno',
                    'url'  => 'turno',
                ],
                 [
                    'text' => 'Asigancion de Aras y turnos de Trabajo',
                    'icon' => 'fas fa-asianacion',
                    'url'  => 'asignacionesturnos',
                ],


            ],
        ],
        [
            'text'    => 'Gestión de Mascotas',
            'icon'    => 'fas fa-paw',
            'submenu' => [

                [
                    'text' => 'Gestión de Razas',
                    'url'  => 'raza',
                    'icon' => 'fas fa-dog',
                ],
                [
                    'text' => 'Gestión de Estados',
                    'url'  => 'estado',
                    'icon' => 'fas fa-heartbeat',
                ],
                [
                    'text' => 'Gestión de Tipos de Tratamientos',
                    'url'  => 'tipotratamiento',
                    'icon' => 'fas fa-notes-medical',
                ],
            ],
        ],

        [
            'text'    => 'Gestión de Tareas y Calificación',
            'icon'    => 'fas fa-tasks',
            'submenu' => [
                [
                    'text' => 'Listado de Tareas',
                    'url'  => 'tarea',
                    'icon' => 'fas fa-list-check', // más representativo que check-circle
                ],
                [
                    'text' => 'Asignación de Tareas',
                    'url'  => 'asignar-tarea',
                    'icon' => 'fas fa-user-plus', // indica asignación o vinculación
                ],
                [
                    'text' => 'Calificaciones',
                    'url'  => 'calificacion',
                    'icon' => 'fas fa-star', // mantiene el ícono de calificación
                ],
            ],
        ],


        [
            'text'    => 'Gestión de Compra y Venta',
            'icon'    => 'fas fa-tasks',
            'submenu' => [
                [
                    'text' => 'Listado de Provedores',
                    'url'  => 'provedor',
                    'icon' => 'fas fa-truck-loading',
                ],
                [
                    'text' => 'Listado de Categorías',
                    'url'  => 'categoria',
                    'icon' => 'fas fa-tags',
                ],
                [
                    'text' => 'Gestión de Productos',
                    'url'  => 'producto',
                    'icon' => 'fas fa-boxes', // Ícono representativo para productos o inventario
                    'title' => 'Ver y administrar los productos disponibles', // Tooltip opcional
                ],
                [
                    'text' => 'Gestión de Notas de Ingreso',
                    'url'  => 'nota_ingreso',
                    'icon' => 'fas fa-file-invoice-dollar', // Ícono relacionado a facturas o ingresos
                ],
                [
                    'text' => 'Gestión de Servicios',
                    'url'  => 'servicio',
                    'icon' => 'fas fa-box-open', // Ícono relacionado a servicios o facturación
                ],
                [
                    'text' => 'Gestión de Promociones',
                    'url'  => 'promociones',
                    'icon' => 'fas fa-tags', // Ícono más representativo de promociones y descuentos
                    'label_color' => 'success',
                ],


            ],
        ],
        [
            'text'    => 'Reportes',
            'icon'    => 'fas fa-chart-bar', // Icono general para reportes
            'submenu' => [
                [
                    'text' => 'Reportes Productos Vencidos General',
                    'url'  => 'reporte/productos-vencidos',
                    'icon' => 'fas fa-calendar-times', // Mejor para indicar vencimientos
                ],
                [
                    'text' => 'Reporte Productos Vencidos por Categoria',
                    'url'  => 'reporte/productos-vencidos/categoria',
                    'icon' => 'fas fa-layer-group', // Representa categorías o agrupaciones
                ],
                [
                    'text' => 'Reporte Calificación',
                    'url'  => 'reporte/calificaciones',
                    'icon' => 'fas fa-star', // Ícono típico de calificación
                    'title' => 'Ver y administrar los productos disponibles',
                ],
                [
                    'text' => 'Reporte Servicios Realizados',
                    'url'  => 'reporte/servicios-realizados',
                    'icon' => 'fas fa-tools', // Relacionado a trabajos o servicios realizados
                ],
                [
                    'text' => 'Reporte Historial Clínico',
                    'url'  => 'reporte/historial-clinico/seleccionar-cliente',
                    'icon' => 'fas fa-notes-medical', // Ícono médico representativo
                ],
                [
                    'text' => 'Reporte Tareas Asignadas por Pasante',
                    'url'  => 'asignaciones/pasantes',
                    'icon' => 'fas fa-notes-medical', // Ícono médico representativo
                ],
                [
                    'text' => 'Reporte Tareas Asignadas por Voluntario',
                    'url'  => 'asignaciones/voluntarios',
                    'icon' => 'fas fa-notes-medical', // Ícono médico representativo
                ],
            ],
        ],

        [
            'text'    => 'Gestión de Adopción',
            'icon'    => 'fas fa-hand-holding-heart',
            'submenu' => [
                [
                    'text' => 'Mascotas en Adopción',
                    'url'  => 'mascotas',
                    'icon' => 'fas fa-dog',
                ],
                [
                    'text' => 'Registro de Adopciones',
                    'url'  => 'adopciones',
                    'icon' => 'fas fa-user-check',
                ],
            ],
        ],



    'menu' => [

    // Navbar search
    [
        'type' => 'navbar-search',
        'text' => 'Buscar',
        'topnav_right' => true,
    ],

    // Sidebar search
    [
        'type' => 'sidebar-menu-search',
        'text' => 'Buscar...',
    ],

    // Roles y permisos
    [
        'text' => 'Gestión de Roles y Permisos',
        'url'  => 'roles',
        'icon' => 'fas fa-user-shield',
    ],

    // Gestión de Personal
    [
        'text' => 'GESTIÓN DE PERSONAL',
        'icon' => 'fas fa-users-cog',
        'submenu' => [
            [
                'text' => 'Registro Personal',
                'url'  => 'personal',
                'icon' => 'fas fa-id-card',
            ],
            [
                'text' => 'Gestión Personal Médico',
                'url'  => 'medico',
                'icon' => 'fas fa-user-md',
            ],
            [
                'text' => 'Gestión Especialidad Médica',
                'url'  => 'especialidad',
                'icon' => 'fas fa-stethoscope',
            ],
            [
                'text' => 'Gestión Personal Atención',
                'url'  => 'atencion',
                'icon' => 'fas fa-headset',
            ],
            [
                'text' => 'Gestión Personal Pasante',
                'url'  => 'pasante',
                'icon' => 'fas fa-user-graduate',
            ],
            [
                'text' => 'Gestión Personal Voluntario',
                'url'  => 'voluntario',
                'icon' => 'fas fa-hands-helping',
            ],
            [
                'text' => 'Gestión Personal Cliente',
                'url'  => 'cliente',
                'icon' => 'fas fa-user',
            ],
            [
                'text' => 'Gestión de Áreas de Trabajo',
                'url'  => 'area',
                'icon' => 'fas fa-th-large',
            ],
            [
                'text' => 'Gestión de Turnos de Trabajo',
                'url'  => 'turno',
                'icon' => 'fas fa-clock',
            ],
            [
                'text' => 'Asignación de Áreas y Turnos',
                'url'  => 'asignacionesturnos',
                'icon' => 'fas fa-exchange-alt',
            ],
        ],
    ],

    // Gestión de Mascotas
    [
        'text' => 'Gestión de Mascotas',
        'icon' => 'fas fa-paw',
        'submenu' => [
            [
                'text' => 'Gestión de Razas',
                'url'  => 'raza',
                'icon' => 'fas fa-dog',
            ],
            [
                'text' => 'Gestión de Estados',
                'url'  => 'estado',
                'icon' => 'fas fa-heartbeat',
            ],
            [
                'text' => 'Tipos de Tratamientos',
                'url'  => 'tipotratamiento',
                'icon' => 'fas fa-notes-medical',
            ],
        ],
    ],

    // Tareas y Calificación
    [
        'text' => 'Gestión de Tareas y Calificación',
        'icon' => 'fas fa-tasks',
        'submenu' => [
            [
                'text' => 'Listado de Tareas',
                'url'  => 'tarea',
                'icon' => 'fas fa-list-check',
            ],
            [
                'text' => 'Asignación de Tareas',
                'url'  => 'asignar-tarea',
                'icon' => 'fas fa-user-plus',
            ],
            [
                'text' => 'Calificaciones',
                'url'  => 'calificaciones',
                'icon' => 'fas fa-star',
            ],
        ],
    ],

    // Compra y Venta
    [
        'text' => 'Gestión de Compra y Venta',
        'icon' => 'fas fa-shopping-cart',
        'submenu' => [
            [
                'text' => 'Listado de Proveedores',
                'url'  => 'provedor',
                'icon' => 'fas fa-truck-loading',
            ],
            [
                'text' => 'Listado de Categorías',
                'url'  => 'categoria',
                'icon' => 'fas fa-tags',
            ],
            [
                'text' => 'Gestión de Productos',
                'url'  => 'producto',
                'icon' => 'fas fa-boxes',
            ],
            [
                'text' => 'Notas de Ingreso',
                'url'  => 'nota_ingreso',
                'icon' => 'fas fa-file-invoice-dollar',
            ],
            [
                'text' => 'Gestión de Servicios',
                'url'  => 'servicio',
                'icon' => 'fas fa-toolbox',
            ],
            [
                'text' => 'Promociones',
                'url'  => 'promociones',
                'icon' => 'fas fa-bullhorn',
            ],
        ],
    ],

    // Reportes
    [
        'text' => 'Reportes',
        'icon' => 'fas fa-chart-bar',
        'submenu' => [
            [
                'text' => 'Productos Vencidos - General',
                'url'  => 'reporte/productos-vencidos',
                'icon' => 'fas fa-calendar-times',
            ],
            [
                'text' => 'Productos Vencidos por Categoría',
                'url'  => 'reporte/productos-vencidos/categoria',
                'icon' => 'fas fa-layer-group',
            ],
            [
                'text' => 'Reporte de Calificaciones',
                'url'  => 'reporte/calificaciones',
                'icon' => 'fas fa-star',
            ],
            [
                'text' => 'Servicios Realizados',
                'url'  => 'reporte/servicios-realizados',
                'icon' => 'fas fa-tools',
            ],
            [
                'text' => 'Historial Clínico',
                'url'  => 'reporte/historial-clinico/seleccionar-cliente',
                'icon' => 'fas fa-notes-medical',
            ],
            [
                'text' => 'Tareas por Pasante',
                'url'  => 'asignaciones/pasantes',
                'icon' => 'fas fa-user-graduate',
            ],
            [
                'text' => 'Tareas por Voluntario',
                'url'  => 'asignaciones/voluntarios',
                'icon' => 'fas fa-hands-helping',
            ],
        ],
    ],

    // Adopciones
    [
        'text' => 'Gestión de Adopción',
        'icon' => 'fas fa-hand-holding-heart',
        'submenu' => [
            [
                'text' => 'Mascotas en Adopción',
                'url'  => 'mascotas',
                'icon' => 'fas fa-dog',
            ],
            [
                'text' => 'Registro de Adopciones',
                'url'  => 'adopciones',
                'icon' => 'fas fa-user-check',
            ],
        ],
    ],
],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For detailed instructions you can look the menu filters section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For detailed instructions you can look the plugins section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Plugins-Configuration
    |
    */

    'plugins' => [
        'Datatables' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
                ],
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | IFrame
    |--------------------------------------------------------------------------
    |
    | Here we change the IFrame mode configuration. Note these changes will
    | only apply to the view that extends and enable the IFrame mode.
    |
    | For detailed instructions you can look the iframe mode section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/IFrame-Mode-Configuration
    |
    */

    'iframe' => [
        'default_tab' => [
            'url' => null,
            'title' => null,
        ],
        'buttons' => [
            'close' => true,
            'close_all' => true,
            'close_all_other' => true,
            'scroll_left' => true,
            'scroll_right' => true,
            'fullscreen' => true,
        ],
        'options' => [
            'loading_screen' => 1000,
            'auto_show_new_tab' => true,
            'use_navbar_items' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For detailed instructions you can look the livewire here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'livewire' => false,
];
