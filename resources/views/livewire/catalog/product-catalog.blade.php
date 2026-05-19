<div class="min-h-screen" style="background-color: #F9FAFB; font-family: 'Inter', sans-serif;">

    @include('partials.navbar')

    <div class="flex">
        <aside class="w-52 min-h-screen pt-4 px-2" style="background-color: white; border-right: 1px solid #E5E7EB;">
            <ul class="space-y-1">
                <li>
                    <a href="/catalog" class="flex items-center gap-3 px-4 py-2 rounded-lg text-sm font-medium" style="background-color:#F0FAF6; color:#111827;">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Inicio
                    </a>
                </li>
                <li>
                    <a href="/cart" class="flex items-center gap-3 px-4 py-2 rounded-lg text-sm" style="color:#111827;">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.5 6h13M10 21a1 1 0 1 0 2 0M17 21a1 1 0 1 0 2 0"/>
                        </svg>
                        Mi Carrito
                    </a>
                </li>
                <li>
                    <a href="/orders" class="flex items-center gap-3 px-4 py-2 rounded-lg text-sm" style="color:#111827;">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        Mis Pedidos
                    </a>
                </li>
                <li>
                    <a href="/profile" class="flex items-center gap-3 px-4 py-2 rounded-lg text-sm" style="color:#111827;">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Mi Perfil
                    </a>
                </li>
            </ul>
        </aside>

        <main class="flex-1 p-8">
            <div class="text-center py-8 px-4 rounded-xl mb-6" style="background-color: #F0FAF6;">
                <h2 class="text-3xl font-bold" style="color:#111827;">Bienvenido a Comadreja Shop</h2>
                <p class="mt-2 text-sm" style="color:#6B7280;">Encuentra los mejores productos al mejor precio</p>
            </div>

            <div class="flex gap-4 items-end flex-wrap mb-6 p-4 bg-white rounded-xl" style="border:1px solid #E5E7EB;">
                <div>
                    <label class="block text-xs mb-1" style="color:#6B7280;">Categoria</label>
                    <select wire:model.live="category_id" class="px-3 py-2 text-sm outline-none" style="border:1px solid #D1D5DB; border-radius:6px; color:#111827; min-width:180px;">
                        <option value="">Todas las categorias</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs mb-1" style="color:#6B7280;">Precio minimo</label>
                    <input wire:model.live="min_price" type="number" placeholder="$0" class="px-3 py-2 text-sm outline-none" style="border:1px solid #D1D5DB; border-radius:6px; color:#111827; width:120px;">
                </div>
                <div>
                    <label class="block text-xs mb-1" style="color:#6B7280;">Precio maximo</label>
                    <input wire:model.live="max_price" type="number" placeholder="$999" class="px-3 py-2 text-sm outline-none" style="border:1px solid #D1D5DB; border-radius:6px; color:#111827; width:120px;">
                </div>
            </div>

            @if(!empty($search))
                <p class="text-sm mb-4" style="color:#6B7280;">Resultados para: <span class="font-medium" style="color:#111827;">"{{ $search }}"</span></p>
            @endif

            @if($products->isEmpty())
                <div class="text-center py-16 bg-white rounded-xl" style="border:1px solid #E5E7EB;">
                    <p class="text-lg" style="color:#6B7280;">No se encontraron productos.</p>
                    <a href="/catalog" class="text-sm mt-2 inline-block" style="color:#2563EB;">Ver todos los productos</a>
                </div>
            @else
                <div class="grid grid-cols-3 gap-6">
                    @foreach($products as $product)
                    <div class="bg-white rounded-xl overflow-hidden relative" style="border:1px solid #E5E7EB; {{ $product->stock == 0 ? 'opacity:0.7;' : '' }}">
                        {{-- Badge agotado --}}
                        @if($product->stock == 0)
                            <div class="absolute top-2 left-2 z-10 px-2 py-1 rounded-full text-xs font-bold text-white" style="background-color:#EF4444;">
                                Agotado
                            </div>
                        @elseif($product->stock <= 5)
                            <div class="absolute top-2 left-2 z-10 px-2 py-1 rounded-full text-xs font-bold text-white" style="background-color:#F59E0B;">
                                Pocas unidades
                            </div>
                        @endif

                        <div class="h-48 flex items-center justify-center" style="background:#F9FAFB;">
                            @if($product->image_url)
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="h-full w-full object-cover">
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="#D1D5DB">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            @endif
                        </div>
                        <div class="p-4">
                            <p class="text-xs mb-1" style="color:#6B7280;">{{ $product->category?->name ?? 'Sin categoria' }}</p>
                            <h3 class="font-medium text-sm mb-2" style="color:#111827;">{{ $product->name }}</h3>
                            <div class="flex items-center justify-between">
                                <span class="font-bold" style="color:#111827;">${{ number_format($product->price, 2) }}</span>
                                @if($product->stock > 0)
                                    <a href="/catalog/{{ $product->id }}" class="px-3 py-1 text-xs text-white rounded-lg" style="background-color:#2563EB;">
                                        Ver detalle
                                    </a>
                                @else
                                    <span class="px-3 py-1 text-xs rounded-lg" style="background-color:#F3F4F6; color:#9CA3AF;">
                                        Sin stock
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif
        </main>
    </div>
</div>
