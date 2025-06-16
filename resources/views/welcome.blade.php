<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Nueva Vida Veterinaria</title>
  <meta name="description" content="Bienvenido a Nueva Vida, tu veterinaria de confianza" />

  <script>
    window.tailwind = {
      config: {
        darkMode: 'class',
      }
    }
  </script>
  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    @keyframes fadeInScale {
      0% {opacity: 0; transform: scale(0.95);}
      100% {opacity: 1; transform: scale(1);}
    }
    .fadeInScale {
      animation: fadeInScale 0.6s ease forwards;
    }
  </style>
</head>
<body class="bg-gradient-to-tr from-green-50 via-green-100 to-green-200 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900
    flex items-center justify-center min-h-screen p-6">

  <div class="fadeInScale bg-white dark:bg-gray-900 max-w-md w-full rounded-3xl shadow-2xl p-10 flex flex-col items-center text-center">

    <img src="https://cdn-icons-png.flaticon.com/512/616/616408.png" alt="Nueva Vida Veterinaria"
         class="w-32 h-32 mb-8 drop-shadow-xl" />

    <h1 class="text-5xl font-extrabold text-green-700 dark:text-green-400 mb-4 select-none leading-tight">
      Nueva Vida
    </h1>

    <p class="text-lg text-gray-700 dark:text-gray-300 mb-8 px-4 leading-relaxed">
      Cuidamos con amor y profesionalismo a tus mascotas,<br>
      ofreciéndote el mejor servicio veterinario.
    </p>

    <div class="flex gap-6 w-full justify-center">
      @if (Route::has('login'))
        @auth
          <a href="{{ url('/panel') }}"
             class="w-1/2 py-3 bg-green-600 hover:bg-green-700 text-white rounded-xl font-semibold shadow-lg transition">
            Ir al Panel
          </a>
        @else
          <a href="{{ route('login') }}"
             class="w-1/2 py-3 border-2 border-green-600 text-green-600 hover:bg-green-600 hover:text-white rounded-xl font-semibold transition text-center">
            Iniciar Sesión
          </a>
        @endauth
      @endif
    </div>
  </div>

  <footer class="absolute bottom-6 text-sm text-gray-600 dark:text-gray-400 select-none">
    &copy; {{ date('Y') }} Nueva Vida Veterinaria. Todos los derechos reservados.
  </footer>

</body>
</html>
