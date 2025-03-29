<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold text-center text-gray-700">Iniciar Sesión</h2>
        
        @if (session()->has('error'))
            <p class="text-red-500 text-center mt-2">{{ session('error') }}</p>
        @endif

        <form wire:submit.prevent="login" class="mt-4">
            <div>
                <label class="block text-gray-700">Correo</label>
                <input type="email" wire:model="email" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring">
                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mt-4">
                <label class="block text-gray-700">Contraseña</label>
                <input type="password" wire:model="password" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring">
                @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mt-6">
                <button type="submit" class="w-full px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700">Entrar</button>
            </div>
        </form>
    </div>
</div>
