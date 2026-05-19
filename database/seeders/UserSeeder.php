<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::firstOrCreate(['email' => 'admin@comadreja.com'], [
            'name'     => 'Administrador',
            'password' => Hash::make('admin123'),
            'role'     => 'admin',
            'active'   => true,
        ]);

        // Vendedores
        User::firstOrCreate(['email' => 'adanballesillo@gmail.com'], [
            'name'     => 'Adan Ballesillo',
            'password' => Hash::make('vendedor123'),
            'role'     => 'vendedor',
            'active'   => true,
        ]);

        User::firstOrCreate(['email' => 'nh091507@gmail.com'], [
            'name'     => 'Jhonatan Guerrero',
            'password' => Hash::make('vendedor123'),
            'role'     => 'vendedor',
            'active'   => true,
        ]);

        // Compradores
        User::firstOrCreate(['email' => 'karenmonica145@gmail.com'], [
            'name'     => 'Karen Hernandez',
            'password' => Hash::make('comprador123'),
            'role'     => 'comprador',
            'active'   => true,
        ]);

        User::firstOrCreate(['email' => 'rnaye738@gmail.com'], [
            'name'     => 'Nayeli Hernandez',
            'password' => Hash::make('comprador123'),
            'role'     => 'comprador',
            'active'   => true,
        ]);
    }
}
