<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-2xl p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold text-center text-gray-700">Regístrate</h2>

        <form wire:submit.prevent="register" class="mt-4">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700">Nombre</label>
                    <input type="text" wire:model="name" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring">
                    @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-gray-700">Apellido Paterno</label>
                    <input type="text" wire:model="ap1" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring">
                    @error('ap1') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-gray-700">Apellido Materno</label>
                    <input type="text" wire:model="ap2" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring">
                    @error('ap2') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-gray-700">Correo</label>
                    <input type="email" wire:model="email" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring">
                    @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-gray-700">CURP</label>
                    <input type="text" wire:model="curp" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring" placeholder="Ingrese su CURP">
                    @error('curp') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-gray-700">Sexo</label>
                    <select wire:model="sexo" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring">
                        <option value="">Selecciona</option>
                        <option value="1">Masculino</option>
                        <option value="2">Femenino</option>
                    </select>
                    @error('sexo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="relative mt-4">
                <label class="block text-gray-700">Contraseña</label>
                <input type="password" wire:model="password" id="register-password" class="w-full px-4 py-2 mt-2 border rounded-lg focus:outline-none focus:ring">
                <button type="button" onclick="togglePasswordVisibility('register-password')" class="absolute inset-y-0 right-3 flex items-center text-gray-500">
                    <i id="register-password-icon"></i>
                </button>
                @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mt-6">
                <button type="submit" class="w-full px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700">Registrar</button>
            </div>
        </form>
    </div>
</div>
