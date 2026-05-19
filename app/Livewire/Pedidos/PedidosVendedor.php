<?php

namespace App\Livewire\Pedidos;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PedidosVendedor extends Component
{
    public function actualizarEstado(int $orderId, string $status): void
    {
        $order = Order::findOrFail($orderId);
        $order->update(['status' => $status]);
        session()->flash('success', 'Estado del pedido actualizado.');
    }

    public function render()
    {
        $productosVendedor = Auth::user()->products()->pluck('id');

        $pedidos = Order::whereHas('items', function ($query) use ($productosVendedor) {
            $query->whereIn('product_id', $productosVendedor);
        })->with(['items.product', 'user'])->latest()->get();

        return view('livewire.pedidos.pedidos-vendedor', [
            'pedidos' => $pedidos,
        ])->layout('layouts.guest');
    }
}
