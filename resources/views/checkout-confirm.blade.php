<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedido Confirmado - Comadreja Shop</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body style="font-family: 'Inter', sans-serif; background-color: #F9FAFB;">
    <nav class="w-full px-6 py-3 flex items-center justify-between" style="background-color: #B9EBD7;">
        <h1 class="text-lg font-bold" style="color: #111827;">Comadreja Shop</h1>
    </nav>
    <main class="max-w-2xl mx-auto px-8 py-16 text-center">
        <div class="bg-white rounded-xl p-10" style="border:1px solid #E5E7EB;">
            <div class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6" style="background-color:#B9EBD7;">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="#0F6B3A">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <h2 class="text-2xl font-bold mb-2" style="color:#111827;">¡Pedido Confirmado!</h2>
            <p class="text-sm mb-4" style="color:#6B7280;">Tu pedido ha sido procesado exitosamente.</p>
            @if(session('order_id'))
                <p class="font-bold mb-2" style="color:#111827;">Número de pedido: ORD-{{ session('order_id') }}</p>
                <p class="text-sm mb-6" style="color:#6B7280;">Total: ${{ number_format(session('order_total'), 2) }}</p>
            @endif
            <p class="text-sm mb-6" style="color:#6B7280;">Tu pedido está siendo procesado y pronto recibirás confirmación.</p>
            <div class="flex gap-3 justify-center">
                <a href="/catalog" class="px-6 py-2 text-white text-sm rounded-lg" style="background-color:#2563EB;">
                    Volver al inicio
                </a>
                <a href="/orders" class="px-6 py-2 text-sm rounded-lg" style="border:1px solid #D1D5DB; color:#111827;">
                    Ver mis pedidos
                </a>
            </div>
        </div>
    </main>
</body>
</html>
