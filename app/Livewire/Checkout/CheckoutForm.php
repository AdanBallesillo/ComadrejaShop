<?php

namespace App\Livewire\Checkout;

use App\Mail\NuevoProductoVendido;
use App\Mail\PedidoConfirmado;
use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class CheckoutForm extends Component
{
    public string $shipping_name = '';
    public string $shipping_address = '';
    public string $shipping_phone = '';
    public string $card_number = '';
    public string $card_expiry = '';
    public string $card_cvv = '';
    public int $step = 1;

    protected function rules(): array
    {
        return [
            'shipping_name'    => 'required|string|max:255',
            'shipping_address' => 'required|string|max:255',
            'shipping_phone'   => 'required|string|max:20',
            'card_number'      => 'required|string|min:16|max:16',
            'card_expiry'      => 'required|string',
            'card_cvv'         => 'required|string|min:3|max:4',
        ];
    }

    protected array $messages = [
        'shipping_name.required'    => 'El nombre del destinatario es obligatorio.',
        'shipping_address.required' => 'La dirección es obligatoria.',
        'shipping_phone.required'   => 'El teléfono es obligatorio.',
        'card_number.required'      => 'El número de tarjeta es obligatorio.',
        'card_number.min'           => 'El número de tarjeta debe tener 16 dígitos.',
        'card_number.max'           => 'El número de tarjeta debe tener 16 dígitos.',
        'card_expiry.required'      => 'La fecha de vencimiento es obligatoria.',
        'card_cvv.required'         => 'El CVV es obligatorio.',
    ];

    public function nextStep(): void
    {
        $this->validate([
            'shipping_name'    => 'required|string|max:255',
            'shipping_address' => 'required|string|max:255',
            'shipping_phone'   => 'required|string|max:20',
        ]);
        $this->step = 2;
    }

    public function placeOrder(): void
    {
        $this->validate();

        $cart = Cart::where('user_id', Auth::id())->first();

        if (!$cart || $cart->items()->count() === 0) {
            $this->redirect(route('cart'));
            return;
        }

        $items = $cart->items()->with('product.user')->get();
        $total = $items->sum(fn($item) => $item->product->price * $item->quantity);

        $order = Order::create([
            'user_id'          => Auth::id(),
            'total'            => $total,
            'status'           => 'pendiente',
            'shipping_name'    => $this->shipping_name,
            'shipping_address' => $this->shipping_address,
            'shipping_phone'   => $this->shipping_phone,
        ]);

        foreach ($items as $item) {
            $order->items()->create([
                'product_id' => $item->product_id,
                'quantity'   => $item->quantity,
                'unit_price' => $item->product->price,
            ]);
            $item->product->decrement('stock', $item->quantity);
        }

        $cart->items()->delete();

        // Correo al comprador
        Mail::to($order->user->email)->send(new PedidoConfirmado($order));

        // Correos a los vendedores
        $vendedores = $items->map(fn($item) => $item->product->user)->unique('id');
        foreach ($vendedores as $vendedor) {
            Mail::to($vendedor->email)->send(new NuevoProductoVendido($order));
        }

        session()->flash('order_id', $order->id);
        session()->flash('order_total', $total);
        $this->redirect(route('checkout.confirm'));
    }

    public function render()
    {
        $cart = Cart::where('user_id', Auth::id())->first();
        $items = $cart ? $cart->items()->with('product')->get() : collect();
        $total = $items->sum(fn($item) => $item->product->price * $item->quantity);

        return view('livewire.checkout.checkout-form', [
            'items' => $items,
            'total' => $total,
        ])->layout('layouts.guest');
    }
}
