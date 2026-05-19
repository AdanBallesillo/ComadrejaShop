<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Usuarios', User::count())
                ->description('Ver todos los usuarios')
                ->descriptionIcon('heroicon-o-arrow-right')
                ->url('/admin/users')
                ->icon('heroicon-o-users')
                ->color('success'),

            Stat::make('Productos', Product::count())
                ->description('Ver todos los productos')
                ->descriptionIcon('heroicon-o-arrow-right')
                ->url('/admin/products')
                ->icon('heroicon-o-shopping-bag')
                ->color('warning'),

            Stat::make('Categorias', Category::count())
                ->description('Ver todas las categorias')
                ->descriptionIcon('heroicon-o-arrow-right')
                ->url('/admin/categories')
                ->icon('heroicon-o-tag')
                ->color('info'),
        ];
    }
}
