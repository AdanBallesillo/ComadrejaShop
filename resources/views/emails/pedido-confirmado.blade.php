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
        .section { margin-bottom:20px; }
        .section h3 { color:#111827; font-size:16px; margin:0 0 12px; border-bottom:2px solid #B9EBD7; padding-bottom:8px; }
        .info-row { display:flex; justify-content:space-between; padding:8px 0; font-size:14px; border-bottom:1px solid #F3F4F6; }
        .info-row span:first-child { color:#6B7280; }
        .info-row span:last-child { color:#111827; font-weight:500; }
        .product-row { display:flex; justify-content:space-between; padding:8px 0; font-size:14px; border-bottom:1px solid #F3F4F6; }
        .total-row { display:flex; justify-content:space-between; padding:12px 0; font-size:16px; font-weight:bold; }
        .status-badge { display:inline-block; background:#FEF3C7; color:#92400E; padding:4px 12px; border-radius:20px; font-size:12px; }
        .footer { background:#F9FAFB; padding:20px; text-align:center; font-size:12px; color:#6B7280; border-top:1px solid #E5E7EB; }
        .btn { display:inline-block; background:#2563EB; color:white; padding:12px 28px; border-radius:8px; text-decoration:none; font-size:14px; margin-top:16px; font-weight:bold; }
        .greeting { font-size:15px; color:#111827; line-height:1.6; margin-bottom:20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🛍️ Comadreja Shop</h1>
            <p>Tu tienda de confianza en línea</p>
        </div>
        <div class="body">
            <div class="success-box">
                <h2>✅ ¡Pedido Confirmado Exitosamente!</h2>
                <p>Estimado/a <strong>{{ $order->user->name }}</strong>, nos complace informarle que su pedido ha sido procesado y confirmado satisfactoriamente. Nos encontramos trabajando para garantizar que su compra llegue en las mejores condiciones.</p>
            </div>

            <p class="greeting">A continuación encontrará el resumen detallado de su pedido. Si tiene alguna duda o consulta, no dude en ponerse en contacto con nosotros.</p>

            <div class="section">
                <h3>📋 Información del Pedido</h3>
                <div class="info-row">
                    <span>Número de pedido</span>
                    <span>#ORD-{{ $order->id }}</span>
                </div>
                <div class="info-row">
                    <span>Fecha de compra</span>
                    <span>{{ $order->created_at->format('d/m/Y H:i') }}</span>
                </div>
                <div class="info-row">
                    <span>Estado actual</span>
                    <span><span class="status-badge">Pendiente de preparación</span></span>
                </div>
            </div>

            <div class="section">
                <h3>📦 Datos de Envío</h3>
                <div class="info-row">
                    <span>Destinatario</span>
                    <span>{{ $order->shipping_name }}</span>
                </div>
                <div class="info-row">
                    <span>Dirección de entrega</span>
                    <span>{{ $order->shipping_address }}</span>
                </div>
                <div class="info-row">
                    <span>Teléfono de contacto</span>
                    <span>{{ $order->shipping_phone }}</span>
                </div>
            </div>

            <div class="section">
                <h3>🛒 Detalle de Productos</h3>
                @foreach($order->items as $item)
                <div class="product-row">
                    <span>{{ $item->product->name }} (x{{ $item->quantity }})</span>
                    <span>${{ number_format($item->unit_price * $item->quantity, 2) }}</span>
                </div>
                @endforeach
                <div class="total-row">
                    <span>Total pagado</span>
                    <span style="color:#2563EB;">${{ number_format($order->total, 2) }}</span>
                </div>
            </div>

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
