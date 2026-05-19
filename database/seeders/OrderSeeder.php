<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $karen   = User::where('email', 'karenmonica145@gmail.com')->first();
        $nayeli  = User::where('email', 'rnaye738@gmail.com')->first();

        // Productos de Adan
        $audifonos = Product::where('name', 'Audifonos Sony WH-1000XM5')->first();
        $laptop    = Product::where('name', 'Laptop HP Pavilion')->first();
        $mouse     = Product::where('name', 'Mouse Inalambrico Logitech')->first();
        $teclado   = Product::where('name', 'Teclado Mecanico Redragon')->first();
        $reloj     = Product::where('name', 'Reloj Inteligente Samsung')->first();
        $tenis     = Product::where('name', 'Tenis Nike Air Max')->first();
        $yoga      = Product::where('name', 'Set de Yoga')->first();
        $guantes   = Product::where('name', 'Guantes de Boxeo')->first();
        $cafetera  = Product::where('name', 'Cafetera Nespresso')->first();
        $lampara   = Product::where('name', 'Lampara de Escritorio LED')->first();

        // Productos de Jhonatan
        $camisa    = Product::where('name', 'Camisa Oxford Azul')->first();
        $sudadera  = Product::where('name', 'Sudadera con Capucha')->first();
        $bolsa     = Product::where('name', 'Bolsa de Mano Elegante')->first();
        $mochila   = Product::where('name', 'Mochila Escolar')->first();
        $crema     = Product::where('name', 'Crema Hidratante Neutrogena')->first();
        $pinceles  = Product::where('name', 'Set de Pinceles Maquillaje')->first();
        $libro     = Product::where('name', 'Libro de Programacion Python')->first();
        $ollas     = Product::where('name', 'Set de Ollas Antiadherentes')->first();
        $bicicleta = Product::where('name', 'Bicicleta de Montana')->first();

        $pedidos = [
            // ── PENDIENTES (3) ──
            ['user' => $karen, 'status' => 'pendiente', 'items' => [[$audifonos, 1], [$mouse, 2]], 'shipping_name' => 'Karen Hernandez', 'shipping_address' => 'Calle Reforma 123, Guadalajara, Jalisco', 'shipping_phone' => '3312345678'],
            ['user' => $nayeli, 'status' => 'pendiente', 'items' => [[$camisa, 1], [$bolsa, 1]], 'shipping_name' => 'Nayeli Hernandez', 'shipping_address' => 'Av. Juarez 456, CDMX', 'shipping_phone' => '5512345678'],
            ['user' => $karen, 'status' => 'pendiente', 'items' => [[$laptop, 1]], 'shipping_name' => 'Karen Hernandez', 'shipping_address' => 'Calle Reforma 123, Guadalajara, Jalisco', 'shipping_phone' => '3312345678'],

            // ── EN PREPARACION (4) ──
            ['user' => $nayeli, 'status' => 'en_preparacion', 'items' => [[$tenis, 1], [$yoga, 1]], 'shipping_name' => 'Nayeli Hernandez', 'shipping_address' => 'Av. Juarez 456, CDMX', 'shipping_phone' => '5512345678'],
            ['user' => $karen, 'status' => 'en_preparacion', 'items' => [[$cafetera, 1], [$lampara, 1]], 'shipping_name' => 'Karen Hernandez', 'shipping_address' => 'Calle Reforma 123, Guadalajara, Jalisco', 'shipping_phone' => '3312345678'],
            ['user' => $nayeli, 'status' => 'en_preparacion', 'items' => [[$sudadera, 2], [$mochila, 1]], 'shipping_name' => 'Nayeli Hernandez', 'shipping_address' => 'Av. Juarez 456, CDMX', 'shipping_phone' => '5512345678'],
            ['user' => $karen, 'status' => 'en_preparacion', 'items' => [[$pinceles, 1], [$crema, 2]], 'shipping_name' => 'Karen Hernandez', 'shipping_address' => 'Calle Reforma 123, Guadalajara, Jalisco', 'shipping_phone' => '3312345678'],

            // ── ENVIADOS (3) ──
            ['user' => $nayeli, 'status' => 'enviado', 'items' => [[$teclado, 1], [$reloj, 1]], 'shipping_name' => 'Nayeli Hernandez', 'shipping_address' => 'Av. Juarez 456, CDMX', 'shipping_phone' => '5512345678'],
            ['user' => $karen, 'status' => 'enviado', 'items' => [[$ollas, 1]], 'shipping_name' => 'Karen Hernandez', 'shipping_address' => 'Calle Reforma 123, Guadalajara, Jalisco', 'shipping_phone' => '3312345678'],
            ['user' => $nayeli, 'status' => 'enviado', 'items' => [[$libro, 2], [$camisa, 1]], 'shipping_name' => 'Nayeli Hernandez', 'shipping_address' => 'Av. Juarez 456, CDMX', 'shipping_phone' => '5512345678'],

            // ── ENTREGADOS (7) ──
            ['user' => $karen, 'status' => 'entregado', 'items' => [[$audifonos, 1], [$tenis, 1]], 'shipping_name' => 'Karen Hernandez', 'shipping_address' => 'Calle Reforma 123, Guadalajara, Jalisco', 'shipping_phone' => '3312345678'],
            ['user' => $nayeli, 'status' => 'entregado', 'items' => [[$laptop, 1]], 'shipping_name' => 'Nayeli Hernandez', 'shipping_address' => 'Av. Juarez 456, CDMX', 'shipping_phone' => '5512345678'],
            ['user' => $karen, 'status' => 'entregado', 'items' => [[$cafetera, 1], [$crema, 1]], 'shipping_name' => 'Karen Hernandez', 'shipping_address' => 'Calle Reforma 123, Guadalajara, Jalisco', 'shipping_phone' => '3312345678'],
            ['user' => $nayeli, 'status' => 'entregado', 'items' => [[$sudadera, 1], [$bolsa, 1]], 'shipping_name' => 'Nayeli Hernandez', 'shipping_address' => 'Av. Juarez 456, CDMX', 'shipping_phone' => '5512345678'],
            ['user' => $karen, 'status' => 'entregado', 'items' => [[$bicicleta, 1]], 'shipping_name' => 'Karen Hernandez', 'shipping_address' => 'Calle Reforma 123, Guadalajara, Jalisco', 'shipping_phone' => '3312345678'],
            ['user' => $nayeli, 'status' => 'entregado', 'items' => [[$guantes, 1], [$yoga, 1]], 'shipping_name' => 'Nayeli Hernandez', 'shipping_address' => 'Av. Juarez 456, CDMX', 'shipping_phone' => '5512345678'],
            ['user' => $karen, 'status' => 'entregado', 'items' => [[$pinceles, 1], [$mochila, 2]], 'shipping_name' => 'Karen Hernandez', 'shipping_address' => 'Calle Reforma 123, Guadalajara, Jalisco', 'shipping_phone' => '3312345678'],
        ];

        foreach ($pedidos as $pedidoData) {
            $total = 0;
            foreach ($pedidoData['items'] as [$producto, $cantidad]) {
                $total += $producto->price * $cantidad;
            }

            $order = Order::create([
                'user_id'          => $pedidoData['user']->id,
                'total'            => $total,
                'status'           => $pedidoData['status'],
                'shipping_name'    => $pedidoData['shipping_name'],
                'shipping_address' => $pedidoData['shipping_address'],
                'shipping_phone'   => $pedidoData['shipping_phone'],
            ]);

            foreach ($pedidoData['items'] as [$producto, $cantidad]) {
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $producto->id,
                    'quantity'   => $cantidad,
                    'unit_price' => $producto->price,
                ]);
            }
        }
    }
}
