<?php

namespace App\Livewire\Compartido;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Navbar extends Component
{
    public string $busqueda = '';

    public function buscar(): void
    {
        if (!empty($this->busqueda)) {
            $this->redirect('/catalog?search=' . urlencode($this->busqueda));
        }
    }

    public function render()
    {
        $totalCarrito = 0;
        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::id())->first();
            $totalCarrito = $cart ? $cart->items()->sum('quantity') : 0;
        }

        return view('livewire.compartido.navbar', [
            'totalCarrito' => $totalCarrito,
        ]);
    }
}
