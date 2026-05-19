<?php

namespace App\Livewire\Pedidos;

use App\Mail\PedidoEntregado;
use App\Mail\PedidoEstadoActualizado;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class DetallePedido extends Component
{
    public Order $pedido;
    public string $status = '';

    public function mount(Order $pedido): void
    {
        $this->pedido = $pedido;
        $this->status = $pedido->status;
    }

    public function actualizarEstado(): void
    {
        $estadoAnterior = $this->pedido->status;
        $this->pedido->update(['status' => $this->status]);

        // Correo al comprador sobre cambio de estado
        Mail::to($this->pedido->user->email)->send(
            new PedidoEstadoActualizado($this->pedido, $estadoAnterior)
        );

        // Si el estado es entregado, correo al vendedor
        if ($this->status === 'entregado') {
            $vendedor = Auth::user();
            Mail::to($vendedor->email)->send(
                new PedidoEntregado($this->pedido)
            );
        }

        session()->flash('success', 'Estado del pedido actualizado correctamente.');
    }

    public function render()
    {
        return view('livewire.pedidos.detalle-pedido')
            ->layout('layouts.guest');
    }
}
