<div class="min-h-screen" style="background-color: #F9FAFB; font-family: 'Inter', sans-serif;">

    @include('partials.navbar')

    <div class="flex flex-col md:flex-row">

        <!-- SIDEBAR -->
        <aside class="w-full md:w-52 min-h-0 md:min-h-screen pt-2 md:pt-4 px-2 md:px-2"
            style="background-color: white; border-bottom: 1px solid #E5E7EB; md:border-right: 1px solid #E5E7EB;">

            <ul class="flex md:block overflow-x-auto md:overflow-visible space-x-2 md:space-x-0 md:space-y-1">

                <li class="flex-shrink-0">
                    <a href="/catalog" class="flex items-center gap-2 md:gap-3 px-3 md:px-4 py-2 rounded-lg text-xs md:text-sm font-medium whitespace-nowrap"
                        style="background-color:#F0FAF6; color:#111827;">
                        <!-- icon -->
                        Inicio
                    </a>
                </li>

                <li class="flex-shrink-0">
                    <a href="/cart" class="flex items-center gap-2 md:gap-3 px-3 md:px-4 py-2 rounded-lg text-xs md:text-sm whitespace-nowrap"
                        style="color:#111827;">
                        Mi Carrito
                    </a>
                </li>

                <li class="flex-shrink-0">
                    <a href="/orders" class="flex items-center gap-2 md:gap-3 px-3 md:px-4 py-2 rounded-lg text-xs md:text-sm whitespace-nowrap"
                        style="color:#111827;">
                        Mis Pedidos
                    </a>
                </li>

                <li class="flex-shrink-0">
                    <a href="/profile" class="flex items-center gap-2 md:gap-3 px-3 md:px-4 py-2 rounded-lg text-xs md:text-sm whitespace-nowrap"
                        style="color:#111827;">
                        Mi Perfil
                    </a>
                </li>

            </ul>
        </aside>

        <!-- MAIN -->
        <main class="flex-1 p-4 md:p-8">

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
            <div class="flex flex-col md:flex-row gap-3 md:gap-4 items-stretch md:items-end flex-wrap mb-6 p-4 bg-white rounded-xl"
                style="border:1px solid #E5E7EB;">

                <div>
                    <label class="block text-xs mb-1" style="color:#6B7280;">Categoria</label>
                    <select wire:model.live="category_id"
                        class="px-3 py-2 text-sm w-full md:w-auto"
                        style="border:1px solid #D1D5DB; border-radius:6px;">
                        <option value="">Todas las categorias</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs mb-1" style="color:#6B7280;">Precio minimo</label>
                    <input wire:model.live="min_price" type="number"
                        class="px-3 py-2 text-sm w-full md:w-[120px]"
                        style="border:1px solid #D1D5DB; border-radius:6px;">
                </div>

                <div>
                    <label class="block text-xs mb-1" style="color:#6B7280;">Precio maximo</label>
                    <input wire:model.live="max_price" type="number"
                        class="px-3 py-2 text-sm w-full md:w-[120px]"
                        style="border:1px solid #D1D5DB; border-radius:6px;">
                </div>
            </div>

            @if($products->isEmpty())
                <div class="text-center py-16 bg-white rounded-xl" style="border:1px solid #E5E7EB;">
                    <p class="text-lg" style="color:#6B7280;">No se encontraron productos.</p>
                    <a href="/catalog" class="text-sm mt-2 inline-block" style="color:#2563EB;">
                        Ver todos los productos
                    </a>
                </div>
            @else

                <!-- GRID RESPONSIVE -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">

                    @foreach($products as $product)
                    <div class="bg-white rounded-xl overflow-hidden relative"
                        style="border:1px solid #E5E7EB; {{ $product->stock == 0 ? 'opacity:0.7;' : '' }}">

                        @if($product->stock == 0)
                            <div class="absolute top-2 left-2 px-2 py-1 text-xs text-white rounded-full"
                                style="background:#EF4444;">Agotado</div>
                        @elseif($product->stock <= 5)
                            <div class="absolute top-2 left-2 px-2 py-1 text-xs text-white rounded-full"
                                style="background:#F59E0B;">Pocas unidades</div>
                        @endif

                        <div class="h-40 md:h-48 flex items-center justify-center" style="background:#F9FAFB;">
                            @if($product->image_url)
                                <img src="{{ $product->image_url }}" class="h-full w-full object-cover">
                            @else
                                <span style="color:#D1D5DB;">Sin imagen</span>
                            @endif
                        </div>

                        <div class="p-3 md:p-4">
                            <p class="text-xs" style="color:#6B7280;">
                                {{ $product->category?->name ?? 'Sin categoria' }}
                            </p>

                            <h3 class="text-sm font-medium" style="color:#111827;">
                                {{ $product->name }}
                            </h3>

                            <div class="flex items-center justify-between mt-2">
                                <span class="font-bold text-sm">
                                    ${{ number_format($product->price, 2) }}
                                </span>

                                @if($product->stock > 0)
                                    <a href="/catalog/{{ $product->id }}"
                                        class="px-3 py-1 text-xs text-white rounded-lg"
                                        style="background:#2563EB;">
                                        Ver
                                    </a>
                                @else
                                    <span class="text-xs px-2 py-1 rounded"
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
</div>