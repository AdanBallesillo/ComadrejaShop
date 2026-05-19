<div class="min-h-screen" style="background-color: #F9FAFB; font-family: 'Inter', sans-serif;">

    @include('partials.navbar')

    <div class="flex flex-col md:flex-row">
        @include('partials.sidebar-vendedor')

        <main class="flex-1 p-4 md:p-8 pb-20 md:pb-8">
            <div class="w-full max-w-lg bg-white rounded-xl p-4 md:p-8" style="border: 1px solid #E5E7EB;">
                <h2 class="text-xl font-bold mb-4" style="color:#111827;">Crear Producto</h2>

                @if (session()->has('success'))
                    <div class="mb-4 px-4 py-3 rounded-lg text-sm" style="background-color: #B9EBD7; color: #111827;">
                        ✓ {{ session('success') }}
                    </div>
                @endif

                <form wire:submit="save" class="space-y-4">
                    <div>
                        <label class="block text-sm mb-1" style="color: #111827;">Nombre</label>
                        <input wire:model="name" type="text" class="w-full px-3 py-2 text-sm outline-none" style="border: 1px solid #D1D5DB; color: #111827; border-radius: 6px;">
                        @error('name') <p class="text-xs mt-1" style="color: #EF4444;">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm mb-1" style="color: #111827;">Descripcion</label>
                        <textarea wire:model="description" rows="3" class="w-full px-3 py-2 text-sm outline-none" style="border: 1px solid #D1D5DB; color: #111827; border-radius: 6px;"></textarea>
                    </div>
                    <div class="flex gap-4">
                        <div class="flex-1">
                            <label class="block text-sm mb-1" style="color: #111827;">Precio</label>
                            <input wire:model="price" type="number" step="0.01" class="w-full px-3 py-2 text-sm outline-none" style="border: 1px solid #D1D5DB; color: #111827; border-radius: 6px;">
                            @error('price') <p class="text-xs mt-1" style="color: #EF4444;">{{ $message }}</p> @enderror
                        </div>
                        <div class="flex-1">
                            <label class="block text-sm mb-1" style="color: #111827;">Stock</label>
                            <input wire:model="stock" type="number" class="w-full px-3 py-2 text-sm outline-none" style="border: 1px solid #D1D5DB; color: #111827; border-radius: 6px;">
                            @error('stock') <p class="text-xs mt-1" style="color: #EF4444;">{{ $message }}</p> @enderror
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm mb-1" style="color: #111827;">Categoria</label>
                        <select wire:model="category_id" class="w-full px-3 py-2 text-sm outline-none" style="border: 1px solid #D1D5DB; color: #111827; border-radius: 6px;">
                            <option value="">-- Selecciona --</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm mb-1" style="color: #111827;">URL de imagen</label>
                        <input wire:model="image_url" type="text" class="w-full px-3 py-2 text-sm outline-none" style="border: 1px solid #D1D5DB; color: #111827; border-radius: 6px;">
                    </div>
                    <div class="flex gap-3 pt-2">
                        <a href="/products" class="flex-1 text-center px-4 py-2 text-sm rounded-lg" style="border: 1px solid #D1D5DB; color: #111827;">Cancelar</a>
                        <button type="submit" class="flex-1 px-4 py-2 text-white text-sm rounded-lg" style="background-color: #2563EB;">Crear</button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</div>
