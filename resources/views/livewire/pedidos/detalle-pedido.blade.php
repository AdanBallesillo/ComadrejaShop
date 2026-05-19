<div class="min-h-screen" style="background-color: #F9FAFB; font-family: 'Inter', sans-serif;">

    @include('partials.navbar')

    <div class="flex flex-col md:flex-row">
        @include('partials.sidebar-vendedor')

        <main class="flex-1 p-4 md:p-8 pb-20 md:pb-8">
            <div class="flex items-center gap-2 text-sm mb-4" style="color:#6B7280;">
                <a href="/vendor/orders" style="color:#2563EB;">Pedidos</a>
                <span>/</span>
                <span>ORD-{{ $pedido->id }}</span>
            </div>

            @if (session()->has('success'))
                <div class="mb-4 px-4 py-3 rounded-lg text-sm" style="background-color: #B9EBD7; color: #111827;">
                    ✓ {{ session('success') }}
                </div>
            @endif

            <div class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-white rounded-xl p-4 md:p-6" style="border:1px solid #E5E7EB;">
                        <h3 class="font-bold mb-3" style="color:#111827;">Informacion del Pedido</h3>
                        <div class="space-y-2">
                            <div class="flex justify-between text-sm">
                                <span style="color:#6B7280;">Numero</span>
                                <span class="font-medium" style="color:#111827;">ORD-{{ $pedido->id }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span style="color:#6B7280;">Fecha</span>
                                <span style="color:#111827;">{{ $pedido->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span style="color:#6B7280;">Total</span>
                                <span class="font-bold" style="color:#111827;">${{ number_format($pedido->total, 2) }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl p-4 md:p-6" style="border:1px solid #E5E7EB;">
                        <h3 class="font-bold mb-3" style="color:#111827;">Datos del Cliente</h3>
                        <div class="space-y-2">
                            <div class="flex justify-between text-sm">
                                <span style="color:#6B7280;">Nombre</span>
                                <span style="color:#111827;">{{ $pedido->user->name }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span style="color:#6B7280;">Destinatario</span>
                                <span style="color:#111827;">{{ $pedido->shipping_name }}</span>
                            </div>
                            <div class="text-sm">
                                <span style="color:#6B7280;">Direccion: </span>
                                <span style="color:#111827;">{{ $pedido->shipping_address }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span style="color:#6B7280;">Telefono</span>
                                <span style="color:#111827;">{{ $pedido->shipping_phone }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl p-4 md:p-6" style="border:1px solid #E5E7EB;">
                    <h3 class="font-bold mb-3" style="color:#111827;">Productos</h3>
                    <div class="space-y-3">
                        @foreach($pedido->items as $item)
                        <div class="flex items-center gap-3 py-2 border-b" style="border-color:#F3F4F6;">
                            @if($item->product->image_url)
                                <img src="{{ $item->product->image_url }}" class="w-12 h-12 rounded-lg object-cover flex-shrink-0">
                            @endif
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium truncate" style="color:#111827;">{{ $item->product->name }}</p>
                                <p class="text-xs" style="color:#6B7280;">x{{ $item->quantity }} - ${{ number_format($item->unit_price, 2) }} c/u</p>
                            </div>
                            <p class="font-bold text-sm flex-shrink-0" style="color:#111827;">${{ number_format($item->unit_price * $item->quantity, 2) }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="bg-white rounded-xl p-4 md:p-6" style="border:1px solid #E5E7EB;">
                    <h3 class="font-bold mb-3" style="color:#111827;">Actualizar Estado</h3>
                    <div class="flex flex-col md:flex-row gap-3">
                        <select wire:model="status" class="flex-1 px-3 py-2 text-sm outline-none" style="border:1px solid #D1D5DB; border-radius:6px; color:#111827;">
                            <option value="pendiente">Pendiente</option>
                            <option value="en_preparacion">En preparacion</option>
                            <option value="enviado">Enviado</option>
                            <option value="entregado">Entregado</option>
                        </select>
                        <button wire:click="actualizarEstado" class="px-5 py-2 text-white text-sm rounded-lg" style="background-color:#2563EB;">
                            Guardar cambios
                        </button>
                        <a href="/vendor/orders" class="text-center px-5 py-2 text-sm rounded-lg" style="border:1px solid #D1D5DB; color:#111827;">
                            Volver
                        </a>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
