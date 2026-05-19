<?php

namespace App\Livewire\Catalog;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProductDetail extends Component
{
    public Product $product;
    public int $quantity = 1;

    public function mount(Product $product): void
    {
        $this->product = $product;
    }

    public function addToCart(): void
    {
        if (!Auth::check()) {
            $this->redirect(route('login'));
            return;
        }

        if ($this->quantity < 1) {
            $this->addError('quantity', 'La cantidad debe ser al menos 1.');
            return;
        }

        if ($this->quantity > $this->product->stock) {
            $this->addError('quantity', 'Solo hay ' . $this->product->stock . ' unidades disponibles.');
            return;
        }

        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
        $item = $cart->items()->where('product_id', $this->product->id)->first();

        if ($item) {
            $nuevaCantidad = $item->quantity + $this->quantity;
            if ($nuevaCantidad > $this->product->stock) {
                $this->addError('quantity', 'No puedes agregar más de ' . $this->product->stock . ' unidades en total.');
                return;
            }
            $item->update(['quantity' => $nuevaCantidad]);
        } else {
            $cart->items()->create([
                'product_id' => $this->product->id,
                'quantity'   => $this->quantity,
            ]);
        }

        session()->flash('cart_success', '¡Producto agregado al carrito!');
        $this->redirect(route('cart'));
    }

    public function render()
    {
        return view('livewire.catalog.product-detail')
            ->layout('layouts.guest');
    }
}
