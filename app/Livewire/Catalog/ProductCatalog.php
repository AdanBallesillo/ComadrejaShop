<?php

namespace App\Livewire\Catalog;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

class ProductCatalog extends Component
{
    public string $search = '';
    public $category_id = '';
    public string $min_price = '';
    public string $max_price = '';

    public function mount(): void
    {
        $this->search = request()->get('search', '');
    }

    public function render()
    {
        $query = Product::where('active', true)->with(['category', 'user']);

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        if ($this->category_id) {
            $query->where('category_id', $this->category_id);
        }

        if ($this->min_price) {
            $query->where('price', '>=', $this->min_price);
        }

        if ($this->max_price) {
            $query->where('price', '<=', $this->max_price);
        }

        // Primero los que tienen stock, luego los agotados
        $query->orderByRaw('stock = 0 ASC')->latest();

        return view('livewire.catalog.product-catalog', [
            'products'   => $query->get(),
            'categories' => Category::orderBy('name')->get(),
        ])->layout('layouts.guest');
    }
}
