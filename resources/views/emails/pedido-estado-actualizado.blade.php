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
        .info-box { background:#F0FAF6; border:1px solid #B9EBD7; border-radius:8px; padding:20px; margin-bottom:20px; text-align:center; }
        .info-box h2 { color:#0F6B3A; margin:0 0 8px; }
        .info-box p { color:#111827; margin:0; font-size:14px; line-height:1.6; }
        .info-row { display:flex; justify-content:space-between; padding:8px 0; font-size:14px; border-bottom:1px solid #F3F4F6; }
        .info-row span:first-child { color:#6B7280; }
        .info-row span:last-child { color:#111827; font-weight:500; }
        .status-box { text-align:center; margin:20px 0; padding:20px; border-radius:8px; background:#DBEAFE; border:1px solid #93C5FD; }
        .status-box p { color:#1E40AF; font-size:18px; font-weight:bold; margin:0; }
        .thanks-box { background:#F0FAF6; border:1px solid #B9EBD7; border-radius:8px; padding:20px; margin-top:20px; text-align:center; }
        .footer { background:#F9FAFB; padding:20px; text-align:center; font-size:12px; color:#6B7280; border-top:1px solid #E5E7EB; }
        .btn { display:inline-block; background:#2563EB; color:white; padding:12px 28px; border-radius:8px; text-decoration:none; font-size:14px; margin-top:16px; font-weight:bold; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🛍️ Comadreja Shop</h1>
            <p>Tu tienda de confianza en línea</p>
        </div>
        <div class="body">
            <div class="info-box">
                <h2>📦 Actualización de Estado de su Pedido</h2>
                <p>Estimado/a <strong>{{ $order->user->name }}</strong>, le informamos que el estado de su pedido ha sido actualizado. A continuación encontrará los detalles del cambio.</p>
            </div>

            <div class="info-row">
                <span>Número de pedido</span>
                <span>#ORD-{{ $order->id }}</span>
            </div>
            <div class="info-row">
                <span>Estado anterior</span>
                <span>{{ ucfirst(str_replace('_', ' ', $estadoAnterior)) }}</span>
            </div>

            <div class="status-box">
                <p>🔄 Nuevo estado: {{ ucfirst(str_replace('_', ' ', $order->status)) }}</p>
            </div>

            @if($order->status === 'entregado')
            <div class="thanks-box">
                <h3 style="color:#0F6B3A; margin:0 0 12px;">🎉 ¡Su pedido ha sido entregado!</h3>
                <p style="color:#111827; font-size:14px; line-height:1.6; margin:0;">
                    Estimado/a <strong>{{ $order->user->name }}</strong>, nos complace confirmarle que su pedido ha sido entregado exitosamente. En <strong>Comadreja Shop</strong> agradecemos profundamente su preferencia y confianza en nuestros productos y servicios. Su satisfacción es nuestro mayor compromiso. ¡Esperamos verle nuevamente pronto!
                </p>
            </div>
            @endif

            <div style="text-align:center;">
                <a href="{{ url('/orders') }}" class="btn">Ver Mis Pedidos</a>
            </div>
        </div>
        <div class="footer">
            <p>Gracias por confiar en <strong>Comadreja Shop</strong>. Su satisfacción es nuestra prioridad.</p>
            <p style="margin-top:8px;">© {{ date('Y') }} Comadreja Shop — Todos los derechos reservados</p>
            <p style="margin-top:4px;">Este mensaje fue generado automáticamente, por favor no responda a este correo.</p>
        </div>
    </div>
</body>
</html>
