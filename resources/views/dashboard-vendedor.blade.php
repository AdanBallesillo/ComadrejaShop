<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Comadreja Shop</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @livewireStyles
</head>
<body style="font-family: 'Inter', sans-serif; background-color: #F9FAFB;">

    @include('partials.navbar')

    <div class="flex flex-col md:flex-row">
        @include('partials.sidebar-vendedor')

        <main class="flex-1 p-4 md:p-8 pb-20 md:pb-8">
            <h2 class="text-lg md:text-xl font-bold mb-6" style="color:#111827;">
                Bienvenido, {{ auth()->user()->name }}
            </h2>

            {{-- Tarjetas de métricas --}}
            <div class="grid grid-cols-2 gap-4 mb-6">

                {{-- Total Productos --}}
                <a href="/products" class="bg-white rounded-xl p-4 md:p-6 flex items-center gap-3 md:gap-4" style="border:1px solid #E5E7EB;">
                    <div class="w-10 h-10 md:w-14 md:h-14 rounded-xl flex items-center justify-center flex-shrink-0" style="background-color:#F0FAF6;">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 md:h-7 md:w-7" fill="none" viewBox="0 0 24 24" stroke="#0F6B3A">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7H4a2 2 0 00-2 2v6a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2zM16 21V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v16"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs md:text-sm" style="color:#6B7280;">Total Productos</p>
                        <p class="text-2xl md:text-3xl font-bold" style="color:#111827;">
                            {{ auth()->user()->products()->count() }}
                        </p>
                        <p class="text-xs hidden md:block" style="color:#2563EB;">Ver mis productos →</p>
                    </div>
                </a>

                {{-- Total Pedidos --}}
                @php
                    $productosVendedor = auth()->user()->products()->pluck('id');
                    $totalPedidos = \App\Models\Order::whereHas('items', function($q) use ($productosVendedor) {
                        $q->whereIn('product_id', $productosVendedor);
                    })->count();
                    $pedidosPendientes = \App\Models\Order::whereHas('items', function($q) use ($productosVendedor) {
                        $q->whereIn('product_id', $productosVendedor);
                    })->where('status', 'pendiente')->count();
                @endphp

                <a href="/vendor/orders" class="bg-white rounded-xl p-4 md:p-6 flex items-center gap-3 md:gap-4" style="border:1px solid #E5E7EB;">
                    <div class="w-10 h-10 md:w-14 md:h-14 rounded-xl flex items-center justify-center flex-shrink-0" style="background-color:#DBEAFE;">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 md:h-7 md:w-7" fill="none" viewBox="0 0 24 24" stroke="#1E40AF">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.5 6h13M10 21a1 1 0 1 0 2 0M17 21a1 1 0 1 0 2 0"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs md:text-sm" style="color:#6B7280;">Total Pedidos</p>
                        <p class="text-2xl md:text-3xl font-bold" style="color:#111827;">{{ $totalPedidos }}</p>
                        <p class="text-xs hidden md:block" style="color:#2563EB;">Ver pedidos →</p>
                    </div>
                </a>
            </div>

            {{-- Resumen --}}
            <div class="bg-white rounded-xl p-4 md:p-6" style="border:1px solid #E5E7EB;">
                <h3 class="font-bold mb-3" style="color:#111827;">Resumen</h3>

                @if($pedidosPendientes > 0)
                    <div class="mb-3 px-4 py-3 rounded-lg text-sm" style="background-color:#FEF3C7; color:#92400E;">
                        ⚠️ Tienes {{ $pedidosPendientes }} pedido(s) pendiente(s) por procesar.
                    </div>
                @endif

                <p class="text-sm mb-4" style="color:#6B7280;">
                    Gestiona tus productos y pedidos desde el menu lateral.
                </p>
                <div class="flex flex-col md:flex-row gap-3">
                    <a href="/products/create" class="text-center px-4 py-2 text-white text-sm rounded-lg" style="background-color:#2563EB;">
                        + Crear producto
                    </a>
                    <a href="/vendor/orders" class="text-center px-4 py-2 text-sm rounded-lg" style="border:1px solid #D1D5DB; color:#111827;">
                        Ver pedidos
                    </a>
                </div>
            </div>
        </main>
    </div>

    @livewireScripts
</body>
</html>
