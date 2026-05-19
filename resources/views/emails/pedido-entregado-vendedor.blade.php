<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; background:#F9FAFB; margin:0; padding:20px; }
        .container { max-width:600px; margin:0 auto; background:white; border-radius:12px; overflow:hidden; border:1px solid #E5E7EB; }
        .header { background-color:#B9EBD7; padding:24px; text-align:center; }
        .header h1 { color:#0F6B3A; margin:0; font-size:24px; }
        .header p { color:#0F6B3A; margin:8px 0 0; font-size:14px; }
        .body { padding:24px; }
        .success-box { background:#F0FAF6; border:1px solid #B9EBD7; border-radius:8px; padding:20px; margin-bottom:20px; text-align:center; }
        .success-box h2 { color:#0F6B3A; margin:0 0 8px; }
        .success-box p { color:#111827; margin:0; font-size:14px; line-height:1.6; }
        .info-row { display:flex; justify-content:space-between; padding:8px 0; font-size:14px; border-bottom:1px solid #F3F4F6; }
        .info-row span:first-child { color:#6B7280; }
        .info-row span:last-child { color:#111827; font-weight:500; }
        .footer { background:#F9FAFB; padding:20px; text-align:center; font-size:12px; color:#6B7280; border-top:1px solid #E5E7EB; }
        .btn { display:inline-block; background:#2563EB; color:white; padding:12px 28px; border-radius:8px; text-decoration:none; font-size:14px; margin-top:16px; font-weight:bold; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🛍️ Comadreja Shop</h1>
            <p>Panel de Vendedor</p>
        </div>
        <div class="body">
            <div class="success-box">
                <h2>✅ Pedido Entregado Exitosamente</h2>
                <p>Le informamos que el pedido <strong>#ORD-{{ $order->id }}</strong> ha sido marcado como entregado. El cliente <strong>{{ $order->user->name }}</strong> ha recibido su compra satisfactoriamente. Agradecemos su compromiso y dedicación como vendedor en <strong>Comadreja Shop</strong>.</p>
            </div>

            <div class="info-row">
                <span>Número de pedido</span>
                <span>#ORD-{{ $order->id }}</span>
            </div>
            <div class="info-row">
                <span>Cliente</span>
                <span>{{ $order->user->name }}</span>
            </div>
            <div class="info-row">
                <span>Total del pedido</span>
                <span style="color:#2563EB; font-weight:bold;">${{ number_format($order->total, 2) }}</span>
            </div>
            <div class="info-row">
                <span>Estado final</span>
                <span style="color:#0F6B3A; font-weight:bold;">✅ Entregado</span>
            </div>

            <div style="text-align:center;">
                <a href="{{ url('/vendor/orders') }}" class="btn">Ver Mis Pedidos</a>
            </div>
        </div>
        <div class="footer">
            <p>Gracias por ser parte de <strong>Comadreja Shop</strong>. ¡Siga vendiendo!</p>
            <p style="margin-top:8px;">© {{ date('Y') }} Comadreja Shop — Todos los derechos reservados</p>
        </div>
    </div>
</body>
</html>
