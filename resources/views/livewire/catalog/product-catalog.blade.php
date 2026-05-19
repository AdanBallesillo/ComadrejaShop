<div class="min-h-screen" style="background-color: #F9FAFB; font-family: 'Inter', sans-serif;">

    @include('partials.navbar')

    <div class="flex flex-col md:flex-row">

        <!-- SIDEBAR (solo desktop) -->
        <aside class="hidden md:block w-52 min-h-screen pt-4 px-2"
            style="background-color: white; border-right: 1px solid #E5E7EB;">

            <ul class="space-y-1">

                <li>
                    <a href="/catalog"
                        class="flex items-center gap-3 px-4 py-2 rounded-lg text-sm font-medium"
                        style="background-color:#F0FAF6; color:#111827;">
                        Inicio
                    </a>
                </li>

                <li>
                    <a href="/cart" class="flex items-center gap-3 px-4 py-2 rounded-lg text-sm"
                        style="color:#111827;">
                        Mi Carrito
                    </a>
                </li>

                <li>
                    <a href="/orders" class="flex items-center gap-3 px-4 py-2 rounded-lg text-sm"
                        style="color:#111827;">
                        Mis Pedidos
                    </a>
                </li>

                <li>
                    <a href="/profile" class="flex items-center gap-3 px-4 py-2 rounded-lg text-sm"
                        style="color:#111827;">
                        Mi Perfil
                    </a>
                </li>

            </ul>
        </aside>

        <!-- MAIN -->
        <main class="flex-1 p-4 md:p-8 pb-20 md:pb-8">

            <!-- HEADER -->
            <div class="text-center py-6 md:py-8 px-4 rounded-xl mb-6"
                style="background-color: #F0FAF6;">
                <h2 class="text-xl md:text-3xl font-bold" style="color:#111827;">
                    Bienvenido a Comadreja Shop
                </h2>
                <p class="mt-2 text-xs md:text-sm" style="color:#6B7280;">
                    Encuentra los mejores productos al mejor precio
                </p>
            </div>

            <!-- FILTROS -->
            <div class="flex flex-col md:flex-row gap-3 mb-6 p-4 bg-white rounded-xl"
                style="border:1px solid #E5E7EB;">

                <select wire:model.live="category_id"
                    class="px-3 py-2 text-sm w-full md:w-auto"
                    style="border:1px solid #D1D5DB; border-radius:6px;">
                    <option value="">Todas las categorias</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>

                <input wire:model.live="min_price" type="number"
                    placeholder="Precio min"
                    class="px-3 py-2 text-sm w-full md:w-32"
                    style="border:1px solid #D1D5DB; border-radius:6px;">

                <input wire:model.live="max_price" type="number"
                    placeholder="Precio max"
                    class="px-3 py-2 text-sm w-full md:w-32"
                    style="border:1px solid #D1D5DB; border-radius:6px;">
            </div>

            @if($products->isEmpty())
                <div class="text-center py-16 bg-white rounded-xl"
                    style="border:1px solid #E5E7EB;">
                    <p class="text-lg" style="color:#6B7280;">
                        No se encontraron productos.
                    </p>
                </div>
            @else

                <!-- GRID: 2 EN MÓVIL, 3 EN DESKTOP -->
                <div class="grid grid-cols-2 md:grid-cols-3 gap-3 md:gap-6">

                    @foreach($products as $product)
                    <div class="bg-white rounded-xl overflow-hidden relative"
                        style="border:1px solid #E5E7EB; {{ $product->stock == 0 ? 'opacity:0.7;' : '' }}">

                        <!-- badges -->
                        @if($product->stock == 0)
                            <div class="absolute top-2 left-2 px-2 py-1 text-[10px] text-white rounded-full"
                                style="background:#EF4444;">Agotado</div>
                        @elseif($product->stock <= 5)
                            <div class="absolute top-2 left-2 px-2 py-1 text-[10px] text-white rounded-full"
                                style="background:#F59E0B;">Pocas</div>
                        @endif

                        <!-- imagen -->
                        <div class="h-28 md:h-48 bg-gray-50 flex items-center justify-center">
                            @if($product->image_url)
                                <img src="{{ $product->image_url }}"
                                    class="h-full w-full object-cover">
                            @endif
                        </div>

                        <!-- info -->
                        <div class="p-2 md:p-4">
                            <p class="text-[10px] md:text-xs" style="color:#6B7280;">
                                {{ $product->category?->name ?? 'Sin categoria' }}
                            </p>

                            <h3 class="text-xs md:text-sm font-medium truncate"
                                style="color:#111827;">
                                {{ $product->name }}
                            </h3>

                            <div class="flex items-center justify-between mt-2">
                                <span class="text-xs md:text-sm font-bold">
                                    ${{ number_format($product->price, 2) }}
                                </span>

                                @if($product->stock > 0)
                                    <a href="/catalog/{{ $product->id }}"
                                        class="px-2 md:px-3 py-1 text-[10px] md:text-xs text-white rounded-lg"
                                        style="background:#2563EB;">
                                        Ver
                                    </a>
                                @else
                                    <span class="text-[10px] md:text-xs px-2 py-1 rounded"
                                        style="background:#F3F4F6; color:#9CA3AF;">
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

    <!-- 🔥 MENU INFERIOR (MÓVIL) -->
    <div class="md:hidden fixed bottom-0 left-0 right-0 bg-white border-t"
        style="border-color:#E5E7EB;">

        <div class="flex justify-around py-2 text-xs">

            <a href="/catalog" class="flex flex-col items-center">
                🏠
                <span>Inicio</span>
            </a>

            <a href="/cart" class="flex flex-col items-center">
                🛒
                <span>Carrito</span>
            </a>

            <a href="/orders" class="flex flex-col items-center">
                📦
                <span>Pedidos</span>
            </a>

            <a href="/profile" class="flex flex-col items-center">
                👤
                <span>Perfil</span>
            </a>

        </div>
    </div>

</div>