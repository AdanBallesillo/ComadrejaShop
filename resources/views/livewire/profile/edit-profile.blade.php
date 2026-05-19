<div class="min-h-screen" style="background-color: #F9FAFB; font-family: 'Inter', sans-serif;">

    @include('partials.navbar')

    <div class="flex flex-col md:flex-row">
        @if(auth()->user()->role === 'vendedor')
            @include('partials.sidebar-vendedor')
        @else
            @include('partials.sidebar-comprador')
        @endif

        <main class="flex-1 p-4 md:p-8 pb-20 md:pb-8">
            <div class="max-w-2xl space-y-4">

                <div class="bg-white rounded-xl p-4 md:p-6" style="border:1px solid #E5E7EB;">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="font-bold text-lg" style="color:#111827;">Mi Perfil</h3>
                        <a href="/profile/edit" class="px-3 py-2 text-white text-sm rounded-lg" style="background-color:#2563EB;">Editar</a>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 rounded-full flex items-center justify-center text-xl font-bold flex-shrink-0"
                            style="background-color:#B9EBD7; color:#0F6B3A;">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <div class="space-y-1 min-w-0">
                            <p class="font-bold truncate" style="color:#111827;">{{ auth()->user()->name }}</p>
                            <p class="text-sm truncate" style="color:#6B7280;">{{ auth()->user()->email }}</p>
                            <span class="text-xs px-2 py-1 rounded-full" style="background-color:#B9EBD7; color:#0F6B3A;">{{ ucfirst(auth()->user()->role) }}</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl p-4 md:p-6" style="border:1px solid #E5E7EB;">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="font-bold" style="color:#111827;">
                            @if(auth()->user()->role === 'vendedor') Pedidos Recibidos @else Pedidos Recientes @endif
                        </h3>
                        @if(auth()->user()->role === 'vendedor')
                            <a href="/vendor/orders" class="text-sm" style="color:#2563EB;">Ver todos</a>
                        @else
                            <a href="/orders" class="text-sm" style="color:#2563EB;">Ver todos</a>
                        @endif
                    </div>

                    @if($pedidos->isEmpty())
                        <p class="text-sm text-center py-4" style="color:#6B7280;">Aun no tienes pedidos</p>
                    @else
                        <div class="space-y-3">
                            @foreach($pedidos as $pedido)
                            <div class="p-3 rounded-lg" style="border:1px solid #F3F4F6;">
                                <div class="flex items-center justify-between">
                                    <p class="text-sm font-medium" style="color:#111827;">ORD-{{ $pedido->id }}</p>
                                    <span class="text-xs px-2 py-1 rounded-full"
                                        style="@if($pedido->status == 'pendiente') background-color:#FEF3C7; color:#92400E; @elseif($pedido->status == 'en_preparacion') background-color:#DBEAFE; color:#1E40AF; @elseif($pedido->status == 'enviado') background-color:#E0E7FF; color:#3730A3; @else background-color:#D1FAE5; color:#065F46; @endif">
                                        {{ ucfirst(str_replace('_', ' ', $pedido->status)) }}
                                    </span>
                                </div>
                                <div class="flex items-center justify-between mt-1">
                                    <p class="text-xs" style="color:#6B7280;">{{ $pedido->created_at->format('d/m/Y') }}</p>
                                    <p class="text-sm font-bold" style="color:#111827;">${{ number_format($pedido->total, 2) }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </main>
    </div>
</div>
