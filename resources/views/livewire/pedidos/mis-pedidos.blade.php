<div class="min-h-screen" style="background-color: #F9FAFB; font-family: 'Inter', sans-serif;">

    @include('partials.navbar')

    <div class="flex flex-col md:flex-row">
        @include('partials.sidebar-comprador')

        <main class="flex-1 p-4 md:p-8 pb-20 md:pb-8">
            <h2 class="text-xl font-bold mb-6" style="color:#111827;">Mis Pedidos</h2>

            @if($pedidos->isEmpty())
                <div class="text-center py-16 bg-white rounded-xl" style="border:1px solid #E5E7EB;">
                    <p class="text-lg font-medium mb-2" style="color:#111827;">Aun no tienes pedidos</p>
                    <a href="/catalog" class="px-6 py-2 text-white text-sm rounded-lg" style="background-color:#2563EB;">Ir al catalogo</a>
                </div>
            @else
                <div class="space-y-4">
                    @foreach($pedidos as $pedido)
                    <div class="bg-white rounded-xl p-4 md:p-6" style="border:1px solid #E5E7EB;">
                        <div class="flex items-center justify-between mb-3">
                            <div>
                                <p class="font-bold text-sm" style="color:#111827;">Pedido #ORD-{{ $pedido->id }}</p>
                                <p class="text-xs" style="color:#6B7280;">{{ $pedido->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                            <div class="flex flex-col md:flex-row items-end md:items-center gap-2">
                                <span class="px-2 py-1 rounded-full text-xs font-medium"
                                    style="@if($pedido->status == 'pendiente') background-color:#FEF3C7; color:#92400E; @elseif($pedido->status == 'en_preparacion') background-color:#DBEAFE; color:#1E40AF; @elseif($pedido->status == 'enviado') background-color:#E0E7FF; color:#3730A3; @else background-color:#D1FAE5; color:#065F46; @endif">
                                    {{ ucfirst(str_replace('_', ' ', $pedido->status)) }}
                                </span>
                                <p class="font-bold text-sm" style="color:#111827;">${{ number_format($pedido->total, 2) }}</p>
                            </div>
                        </div>
                        <div class="border-t pt-3" style="border-color:#F3F4F6;">
                            @foreach($pedido->items as $item)
                            <div class="flex items-center gap-3 mb-2">
                                @if($item->product->image_url)
                                    <img src="{{ $item->product->image_url }}" class="w-8 h-8 rounded-lg object-cover flex-shrink-0">
                                @endif
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium truncate" style="color:#111827;">{{ $item->product->name }}</p>
                                    <p class="text-xs" style="color:#6B7280;">x{{ $item->quantity }} - ${{ number_format($item->unit_price, 2) }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif
        </main>
    </div>
</div>
