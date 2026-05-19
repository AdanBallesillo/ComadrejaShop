<?php

namespace App\Livewire\Products;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProductList extends Component
{
    public function toggleActive(Product $product): void
    {
        $product->update(['active' => !$product->active]);
    }

    public function delete(Product $product): void
    {
        $product->delete();
        session()->flash('success', 'Producto eliminado correctamente.');
    }

    public function render()
    {
        return view('livewire.products.product-list', [
            'products' => Product::where('user_id', Auth::id())
                ->with('category')
                ->latest()
                ->get(),
        ])->layout('layouts.guest');
    }
}
