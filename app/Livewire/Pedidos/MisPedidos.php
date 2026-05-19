<?php

namespace App\Livewire\Pedidos;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MisPedidos extends Component
{
    public function render()
    {
        return view('livewire.pedidos.mis-pedidos', [
            'pedidos' => Order::where('user_id', Auth::id())
                ->with('items.product')
                ->latest()
                ->get(),
        ])->layout('layouts.guest');
    }
}
