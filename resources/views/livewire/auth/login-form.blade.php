<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold text-center text-gray-700">Iniciar Sesión</h2>
        
        @if (session()->has('success'))
            <p class="text-green-500 text-center mt-2">{{ session('success') }}</p>
        @endif

        @if (session()->has('error'))
            <p class="text-red-500 text-center mt-2">{{ session('error') }}</p>
        @endif

        <form wire:submit.prevent="login" class="mt-4">
            <x-input label="Correo" type="email" wire:model="email" />
            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

            <div class="relative mt-4">
                <x-input label="Contraseña" type="password" wire:model="password" id="login-password" />
                <button type="button" onclick="togglePasswordVisibility('login-password')" class="absolute inset-y-0 right-3 flex items-center text-gray-500">
                    <i id="login-password-icon"></i>
                </button>
            </div>
            @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

            <div class="mt-6">
                <x-button type="submit" class="w-full bg-blue-600 hover:bg-blue-700">Entrar</x-button>
            </div>
        </form>

        <div class="mt-4 text-center">
            <a href="{{ route('register') }}" class="text-blue-600 hover:underline">¿No tienes cuenta? Regístrate aquí</a>
        </div>
    </div>
</div>
