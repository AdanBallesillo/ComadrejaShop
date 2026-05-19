<?php

namespace App\Livewire\Products;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EditProduct extends Component
{
    public Product $product;
    public string $name = '';
    public string $description = '';
    public string $price = '';
    public int $stock = 0;
    public string $image_url = '';
    public $category_id = '';

    public function mount(Product $product): void
    {
        if ($product->user_id !== Auth::id()) {
            abort(403);
        }
        $this->product     = $product;
        $this->name        = $product->name;
        $this->description = $product->description ?? '';
        $this->price       = $product->price;
        $this->stock       = $product->stock;
        $this->image_url   = $product->image_url ?? '';
        $this->category_id = $product->category_id ?? '';
    }

    protected function rules(): array
    {
        return [
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0.01',
            'stock'       => 'required|integer|min:0',
            'image_url'   => 'nullable|url',
            'category_id' => 'nullable|exists:categories,id',
        ];
    }

    protected array $messages = [
        'name.required'  => 'El nombre es obligatorio.',
        'price.required' => 'El precio es obligatorio.',
        'price.numeric'  => 'El precio debe ser un número.',
        'price.min'      => 'El precio debe ser mayor a 0.',
        'stock.required' => 'El stock es obligatorio.',
        'stock.min'      => 'El stock no puede ser negativo.',
        'image_url.url'  => 'Ingresa una URL válida.',
    ];

    public function save(): void
    {
        $this->validate();
        $this->product->update([
            'category_id' => $this->category_id ?: null,
            'name'        => $this->name,
            'description' => $this->description,
            'price'       => $this->price,
            'stock'       => $this->stock,
            'image_url'   => $this->image_url ?: null,
        ]);
        session()->flash('success', 'Producto actualizado correctamente.');
        $this->redirect(route('products.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.products.edit-product', [
            'categories' => Category::orderBy('name')->get(),
        ])->layout('layouts.guest');
    }
}
