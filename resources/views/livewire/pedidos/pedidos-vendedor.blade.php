<div class="min-h-screen" style="background-color: #F9FAFB; font-family: 'Inter', sans-serif;">

    @include('partials.navbar')

    <div class="flex flex-col md:flex-row">
        @include('partials.sidebar-vendedor')

        <main class="flex-1 p-4 md:p-8 pb-20 md:pb-8">
            <h2 class="text-xl font-bold mb-4" style="color:#111827;">Pedidos Recibidos</h2>

            @if($pedidos->isEmpty())
                <div class="text-center py-16 bg-white rounded-xl" style="border:1px solid #E5E7EB;">
                    <p class="text-lg font-medium mb-2" style="color:#111827;">Aun no tienes pedidos</p>
                    <p class="text-sm" style="color:#6B7280;">Cuando un comprador adquiera tus productos apareceran aqui</p>
                </div>
            @else
                {{-- Vista movil: tarjetas --}}
                <div class="md:hidden space-y-3">
                    @foreach($pedidos as $pedido)
                    <a href="/vendor/orders/{{ $pedido->id }}" class="block bg-white rounded-xl p-4" style="border:1px solid #E5E7EB;">
                        <div class="flex items-center justify-between mb-2">
                            <p class="font-bold text-sm" style="color:#111827;">ORD-{{ $pedido->id }}</p>
                            <span class="text-xs px-2 py-1 rounded-full"
                                style="@if($pedido->status == 'pendiente') background-color:#FEF3C7; color:#92400E; @elseif($pedido->status == 'en_preparacion') background-color:#DBEAFE; color:#1E40AF; @elseif($pedido->status == 'enviado') background-color:#E0E7FF; color:#3730A3; @else background-color:#D1FAE5; color:#065F46; @endif">
                                {{ ucfirst(str_replace('_', ' ', $pedido->status)) }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm" style="color:#111827;">{{ $pedido->user->name }}</p>
                                <p class="text-xs" style="color:#6B7280;">{{ $pedido->created_at->format('d/m/Y') }}</p>
                            </div>
                            <p class="font-bold text-sm" style="color:#111827;">${{ number_format($pedido->total, 2) }}</p>
                        </div>
                    </a>
                    @endforeach
                </div>

                {{-- Vista desktop: tabla --}}
                <div class="hidden md:block bg-white rounded-xl overflow-hidden" style="border:1px solid #E5E7EB;">
                    <table class="w-full text-sm">
                        <thead>
                            <tr style="background-color:#F9FAFB; border-bottom:1px solid #E5E7EB;">
                                <th class="px-4 py-3 text-left font-medium" style="color:#6B7280;">Pedido</th>
                                <th class="px-4 py-3 text-left font-medium" style="color:#6B7280;">Cliente</th>
                                <th class="px-4 py-3 text-left font-medium" style="color:#6B7280;">Fecha</th>
                                <th class="px-4 py-3 text-left font-medium" style="color:#6B7280;">Total</th>
                                <th class="px-4 py-3 text-left font-medium" style="color:#6B7280;">Estado</th>
                                <th class="px-4 py-3 text-left font-medium" style="color:#6B7280;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pedidos as $pedido)
                            <tr style="border-bottom:1px solid #F3F4F6;">
                                <td class="px-4 py-3 font-medium" style="color:#111827;">ORD-{{ $pedido->id }}</td>
                                <td class="px-4 py-3" style="color:#111827;">{{ $pedido->user->name }}</td>
                                <td class="px-4 py-3" style="color:#6B7280;">{{ $pedido->created_at->format('d/m/Y') }}</td>
                                <td class="px-4 py-3 font-medium" style="color:#111827;">${{ number_format($pedido->total, 2) }}</td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-1 rounded-full text-xs font-medium"
                                        style="@if($pedido->status == 'pendiente') background-color:#FEF3C7; color:#92400E; @elseif($pedido->status == 'en_preparacion') background-color:#DBEAFE; color:#1E40AF; @elseif($pedido->status == 'enviado') background-color:#E0E7FF; color:#3730A3; @else background-color:#D1FAE5; color:#065F46; @endif">
                                        {{ ucfirst(str_replace('_', ' ', $pedido->status)) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    <a href="/vendor/orders/{{ $pedido->id }}" class="px-3 py-1 text-white text-xs rounded-lg" style="background-color:#2563EB;">
                                        Ver detalle
                                    </a>
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
