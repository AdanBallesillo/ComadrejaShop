<div class="min-h-screen flex items-center justify-center" style="background-color: #F9FAFB;">
    <div class="w-full max-w-md bg-white rounded-xl shadow-md p-8" style="border: 1px solid #B9EBD7;">

        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold" style="color: #111827; font-family: 'Inter', sans-serif;">
                Comadreja Shop
            </h1>
            <p class="text-sm mt-1" style="color: #6B7280;">Inicia sesión en tu cuenta</p>
        </div>

        <form wire:submit="login" class="space-y-4">

            <div>
                <label class="block text-sm font-medium mb-1" style="color: #111827;">Correo electrónico</label>
                <input wire:model="email" type="email" placeholder="correo@ejemplo.com"
                    class="w-full px-4 py-2 rounded-lg text-sm outline-none"
                    style="border: 1px solid #B9EBD7; background: #F9FAFB; color: #111827; border-radius: 10px;">
                @error('email') <p class="text-xs mt-1" style="color: #EF4444;">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-1" style="color: #111827;">Contraseña</label>
                <input wire:model="password" type="password" placeholder="Tu contraseña"
                    class="w-full px-4 py-2 rounded-lg text-sm outline-none"
                    style="border: 1px solid #B9EBD7; background: #F9FAFB; color: #111827; border-radius: 10px;">
                @error('password') <p class="text-xs mt-1" style="color: #EF4444;">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center gap-2">
                <input wire:model="remember" type="checkbox" id="remember" class="rounded">
                <label for="remember" class="text-sm" style="color: #6B7280;">Recordarme</label>
            </div>

            <button type="submit"
                class="w-full py-2 rounded-lg text-white font-semibold text-sm transition hover:opacity-90"
                style="background-color: #2563EB; border-radius: 10px;">
                Iniciar sesión
            </button>

        </form>

        <p class="text-center text-sm mt-4" style="color: #6B7280;">
            ¿No tienes cuenta?
            <a href="/register" class="font-medium hover:underline" style="color: #2563EB;">Regístrate</a>
        </p>
    </div>
</div>
