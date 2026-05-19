<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PedidoEstadoActualizado extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Order $order, public string $estadoAnterior) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Tu pedido #ORD-' . $this->order->id . ' ha sido actualizado - Comadreja Shop',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.pedido-estado-actualizado',
        );
    }
}
