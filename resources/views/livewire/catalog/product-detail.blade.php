<div class="min-h-screen" style="background-color: #F9FAFB; font-family: 'Inter', sans-serif;">

    @include('partials.navbar')

    <main class="max-w-4xl mx-auto px-4 md:px-8 py-6 md:py-10 pb-20 md:pb-10">
        <div class="flex items-center gap-2 text-sm mb-4" style="color:#6B7280;">
            <a href="/catalog" style="color:#2563EB;">Catalogo</a>
            <span>/</span>
            <span class="truncate">{{ $product->name }}</span>
        </div>

        @if (session()->has('cart_success'))
            <div class="mb-4 px-4 py-3 rounded-lg text-sm" style="background-color: #B9EBD7; color: #111827;">
                ✓ {{ session('cart_success') }}
                <a href="/cart" class="ml-2 underline font-medium">Ver carrito</a>
            </div>
        @endif

        <div class="bg-white rounded-xl p-4 md:p-8 flex flex-col md:flex-row gap-6" style="border:1px solid #E5E7EB;">
            <div class="w-full md:w-80 h-64 md:h-80 flex items-center justify-center rounded-xl overflow-hidden flex-shrink-0" style="background:#F9FAFB; border:1px solid #E5E7EB;">
                @if($product->image_url)
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24" fill="none" viewBox="0 0 24 24" stroke="#D1D5DB">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                @endif
            </div>
            <div class="flex-1">
                <p class="text-xs mb-1" style="color:#6B7280;">{{ $product->category?->name ?? 'Sin categoria' }}</p>
                <h2 class="text-xl md:text-2xl font-bold mb-2" style="color:#111827;">{{ $product->name }}</h2>
                <p class="text-2xl md:text-3xl font-bold mb-3" style="color:#111827;">${{ number_format($product->price, 2) }}</p>
                @if($product->description)
                    <p class="text-sm mb-3" style="color:#6B7280;">{{ $product->description }}</p>
                @endif
                <p class="text-sm mb-4" style="color:#6B7280;">
                    Stock: <span class="font-medium" style="color:#111827;">{{ $product->stock }} unidades</span>
                </p>
                @auth
                    @if(auth()->user()->role === 'comprador')
                        <div class="flex items-center gap-3 mb-4">
                            <label class="text-sm font-medium" style="color:#111827;">Cantidad</label>
                            <input wire:model="quantity" type="number" min="1" max="{{ $product->stock }}"
                                class="px-3 py-2 text-sm outline-none w-24"
                                style="border:1px solid #D1D5DB; border-radius:6px; color:#111827;">
                        </div>
                        <button wire:click="addToCart" class="w-full md:w-auto px-6 py-2 text-white text-sm rounded-lg font-medium" style="background-color:#2563EB;">
                            Agregar al carrito
                        </button>
                    @else
                        <p class="text-sm" style="color:#6B7280;">Solo los compradores pueden agregar productos al carrito.</p>
                    @endif
                @else
                    <a href="/login" class="block w-full md:w-auto text-center px-6 py-2 text-white text-sm rounded-lg font-medium" style="background-color:#2563EB;">
                        Iniciar sesion para comprar
                    </a>
                @endauth
            </div>
        </div>
    </main>
</div>
