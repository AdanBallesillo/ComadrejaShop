<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $adan     = User::where('email', 'adanballesillo@gmail.com')->first();
        $jhonatan = User::where('email', 'nh091507@gmail.com')->first();

        $electronica = Category::where('name', 'Electronica')->first();
        $ropa        = Category::where('name', 'Ropa')->first();
        $deportes    = Category::where('name', 'Deportes')->first();
        $hogar       = Category::where('name', 'Hogar')->first();
        $belleza     = Category::where('name', 'Belleza')->first();
        $libros      = Category::where('name', 'Libros')->first();
        $juguetes    = Category::where('name', 'Juguetes')->first();

        $productos = [
            // Adan - Electronica
            ['name' => 'Audifonos Sony WH-1000XM5', 'description' => 'Audifonos inalambricos con cancelacion de ruido y 30 horas de bateria', 'price' => 89.99, 'stock' => 50, 'category_id' => $electronica?->id, 'image_url' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=400', 'user_id' => $adan?->id],
            ['name' => 'Laptop HP Pavilion', 'description' => 'Laptop de 15 pulgadas con procesador Intel Core i5 y 8GB RAM', 'price' => 1299.99, 'stock' => 10, 'category_id' => $electronica?->id, 'image_url' => 'https://images.unsplash.com/photo-1496181133206-80ce9b88a853?w=400', 'user_id' => $adan?->id],
            ['name' => 'Mouse Inalambrico Logitech', 'description' => 'Mouse ergonomico con bateria de larga duracion', 'price' => 55.00, 'stock' => 40, 'category_id' => $electronica?->id, 'image_url' => 'https://images.unsplash.com/photo-1527864550417-7fd91fc51a46?w=400', 'user_id' => $adan?->id],
            ['name' => 'Teclado Mecanico Redragon', 'description' => 'Teclado mecanico con switches azules y retroiluminacion RGB', 'price' => 320.00, 'stock' => 25, 'category_id' => $electronica?->id, 'image_url' => 'https://images.unsplash.com/photo-1587829741301-dc798b83add3?w=400', 'user_id' => $adan?->id],
            ['name' => 'Reloj Inteligente Samsung', 'description' => 'Smartwatch con monitor cardiaco y GPS integrado', 'price' => 250.00, 'stock' => 20, 'category_id' => $electronica?->id, 'image_url' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=400', 'user_id' => $adan?->id],

            // Adan - Deportes
            ['name' => 'Tenis Nike Air Max', 'description' => 'Tenis deportivos comodos para uso diario', 'price' => 300.00, 'stock' => 30, 'category_id' => $deportes?->id, 'image_url' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=400', 'user_id' => $adan?->id],
            ['name' => 'Set de Yoga', 'description' => 'Kit completo con tapete, bloques y correa', 'price' => 180.00, 'stock' => 25, 'category_id' => $deportes?->id, 'image_url' => 'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?w=400', 'user_id' => $adan?->id],
            ['name' => 'Guantes de Boxeo', 'description' => 'Guantes profesionales de cuero sintetico 12oz', 'price' => 220.00, 'stock' => 30, 'category_id' => $deportes?->id, 'image_url' => 'https://images.unsplash.com/photo-1549719386-74dfcbf7dbed?w=400', 'user_id' => $adan?->id],

            // Adan - Hogar
            ['name' => 'Cafetera Nespresso', 'description' => 'Cafetera de capsulas con calentamiento rapido', 'price' => 450.00, 'stock' => 20, 'category_id' => $hogar?->id, 'image_url' => 'https://images.unsplash.com/photo-1570087552987-5e6f88bc8ae6?w=400', 'user_id' => $adan?->id],
            ['name' => 'Lampara de Escritorio LED', 'description' => 'Lampara con luz ajustable y puerto USB', 'price' => 75.00, 'stock' => 30, 'category_id' => $hogar?->id, 'image_url' => 'https://images.unsplash.com/photo-1507473885765-e6ed057f782c?w=400', 'user_id' => $adan?->id],

            // Jhonatan - Ropa
            ['name' => 'Camisa Oxford Azul', 'description' => 'Camisa de algodon para ocasiones formales', 'price' => 299.99, 'stock' => 20, 'category_id' => $ropa?->id, 'image_url' => 'https://images.unsplash.com/photo-1598033129183-c4f50c736f10?w=400', 'user_id' => $jhonatan?->id],
            ['name' => 'Sudadera con Capucha', 'description' => 'Sudadera de algodon suave con bolsillo canguro', 'price' => 180.00, 'stock' => 40, 'category_id' => $ropa?->id, 'image_url' => 'https://images.unsplash.com/photo-1556821840-3a63f15732ce?w=400', 'user_id' => $jhonatan?->id],
            ['name' => 'Bolsa de Mano Elegante', 'description' => 'Bolsa de piel sintetica para ocasiones especiales', 'price' => 200.00, 'stock' => 15, 'category_id' => $ropa?->id, 'image_url' => 'https://images.unsplash.com/photo-1584917865442-de89df76afd3?w=400', 'user_id' => $jhonatan?->id],
            ['name' => 'Mochila Escolar', 'description' => 'Mochila resistente con compartimentos para laptop', 'price' => 120.00, 'stock' => 45, 'category_id' => $ropa?->id, 'image_url' => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=400', 'user_id' => $jhonatan?->id],

            // Jhonatan - Belleza y Libros
            ['name' => 'Crema Hidratante Neutrogena', 'description' => 'Crema facial hidratante con SPF 50', 'price' => 65.00, 'stock' => 60, 'category_id' => $belleza?->id, 'image_url' => 'https://images.unsplash.com/photo-1556228578-8c89e6adf883?w=400', 'user_id' => $jhonatan?->id],
            ['name' => 'Set de Pinceles Maquillaje', 'description' => 'Kit de 12 pinceles profesionales para maquillaje facial', 'price' => 95.00, 'stock' => 45, 'category_id' => $belleza?->id, 'image_url' => 'https://images.unsplash.com/photo-1512496015851-a90fb38ba796?w=400', 'user_id' => $jhonatan?->id],
            ['name' => 'Libro de Programacion Python', 'description' => 'Guia completa de Python para principiantes y avanzados', 'price' => 45.00, 'stock' => 50, 'category_id' => $libros?->id, 'image_url' => 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=400', 'user_id' => $jhonatan?->id],
            ['name' => 'Juego de Mesa Catan', 'description' => 'Juego de estrategia para 3-4 jugadores', 'price' => 380.00, 'stock' => 0, 'category_id' => $juguetes?->id, 'image_url' => 'https://images.unsplash.com/photo-1610890716171-6b1bb98ffd09?w=400', 'user_id' => $jhonatan?->id],

            // Jhonatan - Hogar
            ['name' => 'Set de Ollas Antiadherentes', 'description' => 'Juego de 5 ollas de acero inoxidable', 'price' => 550.00, 'stock' => 12, 'category_id' => $hogar?->id, 'image_url' => 'https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=400', 'user_id' => $jhonatan?->id],
            ['name' => 'Bicicleta de Montana', 'description' => 'Bicicleta todoterreno con 21 velocidades y frenos de disco', 'price' => 2500.00, 'stock' => 5, 'category_id' => $deportes?->id, 'image_url' => 'https://images.unsplash.com/photo-1485965120184-e220f721d03e?w=400', 'user_id' => $jhonatan?->id],
        ];

        foreach ($productos as $producto) {
            Product::firstOrCreate(
                ['name' => $producto['name']],
                array_merge($producto, ['active' => true])
            );
        }
    }
}
