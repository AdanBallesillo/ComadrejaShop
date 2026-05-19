<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Electronica', 'description' => 'Dispositivos electronicos y gadgets'],
            ['name' => 'Ropa', 'description' => 'Ropa y accesorios de moda'],
            ['name' => 'Hogar', 'description' => 'Articulos para el hogar'],
            ['name' => 'Deportes', 'description' => 'Articulos deportivos'],
            ['name' => 'Juguetes', 'description' => 'Juguetes y juegos'],
            ['name' => 'Libros', 'description' => 'Libros y material educativo'],
            ['name' => 'Belleza', 'description' => 'Productos de belleza y cuidado personal'],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(['name' => $category['name']], $category);
        }
    }
}
