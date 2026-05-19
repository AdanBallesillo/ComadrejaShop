<div class="min-h-screen" style="background-color: #F9FAFB; font-family: 'Inter', sans-serif;">

    @include('partials.navbar')

    <div class="flex flex-col md:flex-row">
        @include('partials.sidebar-vendedor')

        <main class="flex-1 p-4 md:p-8 pb-20 md:pb-8">
            @if (session()->has('success'))
                <div class="mb-4 px-4 py-3 rounded-lg text-sm" style="background-color: #B9EBD7; color: #111827;">
                    ✓ {{ session('success') }}
                </div>
            @endif
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold" style="color:#111827;">Mis Productos</h2>
                <a href="/products/create" class="px-3 py-2 text-white text-sm rounded-lg" style="background-color:#2563EB;">+ Crear</a>
            </div>

            @if($products->isEmpty())
                <div class="text-center py-16 bg-white rounded-xl" style="border:1px solid #E5E7EB;">
                    <p class="text-lg" style="color:#6B7280;">Aun no tienes productos.</p>
                    <a href="/products/create" class="text-sm mt-2 inline-block" style="color:#2563EB;">Crea tu primer producto</a>
                </div>
            @else
                {{-- Vista movil: tarjetas --}}
                <div class="md:hidden space-y-3">
                    @foreach($products as $product)
                    <div class="bg-white rounded-xl p-4" style="border:1px solid #E5E7EB;">
                        <div class="flex gap-3">
                            <div class="w-16 h-16 rounded-lg overflow-hidden flex-shrink-0" style="background:#F9FAFB;">
                                @if($product->image_url)
                                    <img src="{{ $product->image_url }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center" style="background:#F3F4F6;">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="#9CA3AF">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="font-medium text-sm truncate mb-1" style="color:#111827;">{{ $product->name }}</h3>
                                <p class="text-sm font-bold mb-1" style="color:#111827;">${{ number_format($product->price, 2) }}</p>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <span class="text-xs px-2 py-1 rounded-full" style="{{ $product->active ? 'background-color:#D1FAE5; color:#065F46;' : 'background-color:#FEE2E2; color:#991B1B;' }}">
                                            {{ $product->active ? 'Activo' : 'Inactivo' }}
                                        </span>
                                        <span class="text-xs" style="color:#6B7280;">Stock: {{ $product->stock }}</span>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <a href="/products/{{ $product->id }}/edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="#2563EB">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </a>
                                        <button wire:click="toggleActive({{ $product->id }})">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="{{ $product->active ? '#F59E0B' : '#10B981' }}">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                        </button>
                                        <button wire:click="delete({{ $product->id }})" wire:confirm="Estas seguro de eliminar este producto?">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="#EF4444">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- Vista desktop: tabla --}}
                <div class="hidden md:block bg-white rounded-xl overflow-hidden" style="border:1px solid #E5E7EB;">
                    <table class="w-full text-sm">
                        <thead>
                            <tr style="background-color:#F9FAFB; border-bottom:1px solid #E5E7EB;">
                                <th class="px-4 py-3 text-left font-medium" style="color:#6B7280;">Imagen</th>
                                <th class="px-4 py-3 text-left font-medium" style="color:#6B7280;">Nombre</th>
                                <th class="px-4 py-3 text-left font-medium" style="color:#6B7280;">Precio</th>
                                <th class="px-4 py-3 text-left font-medium" style="color:#6B7280;">Stock</th>
                                <th class="px-4 py-3 text-left font-medium" style="color:#6B7280;">Estado</th>
                                <th class="px-4 py-3 text-left font-medium" style="color:#6B7280;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr style="border-bottom:1px solid #F3F4F6;">
                                <td class="px-4 py-3">
                                    @if($product->image_url)
                                        <img src="{{ $product->image_url }}" class="w-12 h-12 object-cover rounded-lg">
                                    @else
                                        <div class="w-12 h-12 rounded-lg flex items-center justify-center" style="background:#F3F4F6;">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="#9CA3AF">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-4 py-3 font-medium" style="color:#111827;">{{ $product->name }}</td>
                                <td class="px-4 py-3" style="color:#111827;">${{ number_format($product->price, 2) }}</td>
                                <td class="px-4 py-3" style="color:#111827;">{{ $product->stock }}</td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-1 rounded-full text-xs font-medium" style="{{ $product->active ? 'background-color:#D1FAE5; color:#065F46;' : 'background-color:#FEE2E2; color:#991B1B;' }}">
                                        {{ $product->active ? 'Activo' : 'Inactivo' }}
                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-2">
                                        <a href="/products/{{ $product->id }}/edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="#2563EB">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </a>
                                        <button wire:click="toggleActive({{ $product->id }})">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="{{ $product->active ? '#F59E0B' : '#10B981' }}">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                        </button>
                                        <button wire:click="delete({{ $product->id }})" wire:confirm="Estas seguro de eliminar este producto?">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="#EF4444">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </main>
    </div>
</div>
