<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Código -->
        <div>
            <x-input-label for="codigo" :value="__('Código')" class="text-gray-700 dark:text-gray-300" />
            <x-text-input id="codigo" class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-700
                           focus:border-green-600 focus:ring focus:ring-green-300 dark:focus:ring-green-700
                           dark:bg-gray-800 dark:text-white"
                          type="text" name="codigo" :value="old('codigo')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('codigo')" class="mt-2 text-red-600 text-sm" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Contraseña')" class="text-gray-700 dark:text-gray-300" />

            <x-text-input id="password" class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-700
                           focus:border-green-600 focus:ring focus:ring-green-300 dark:focus:ring-green-700
                           dark:bg-gray-800 dark:text-white"
                          type="password" name="password" required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-600 text-sm" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-green-600 shadow-sm focus:ring-green-500 dark:focus:ring-green-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-700 dark:text-gray-400">{{ __('Recordarme') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-green-700 dark:text-green-400 hover:text-green-900 dark:hover:text-green-300 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-600 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('¿Olvidaste tu contraseña?') }}
                </a>
            @endif

            <x-primary-button class="ms-3 bg-green-600 hover:bg-green-700 focus:ring-green-500">
                {{ __('Ingresar') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
