<?php

namespace App\Livewire\Chatbot;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class ChatFlotante extends Component
{
    public bool $abierto = false;
    public string $mensaje = '';
    public array $mensajes = [];
    public bool $cargando = false;

    public function toggle(): void
    {
        $this->abierto = !$this->abierto;
    }

    public function enviarMensaje(): void
    {
        if (empty(trim($this->mensaje))) return;

        $this->mensajes[] = [
            'rol' => 'usuario',
            'texto' => $this->mensaje,
        ];

        $this->cargando = true;
        $mensajeActual = $this->mensaje;
        $this->mensaje = '';

        try {
            $response = Http::withHeaders([
                'x-api-key' => config('anthropic.api_key'),
                'anthropic-version' => '2023-06-01',
                'content-type' => 'application/json',
            ])->post('https://api.anthropic.com/v1/messages', [
                'model' => 'claude-sonnet-4-5',
                'max_tokens' => 400,
                'system' => $this->obtenerContexto(),
                'messages' => $this->obtenerHistorial($mensajeActual),
            ]);

            $data = $response->json();
            $respuesta = $data['content'][0]['text'] ?? 'Lo siento, intenta de nuevo.';
        } catch (\Exception $e) {
            $respuesta = 'Lo siento, ocurrio un error. Intenta de nuevo.';
        }

        $this->mensajes[] = [
            'rol' => 'asistente',
            'texto' => $respuesta,
        ];

        $this->cargando = false;
    }

    private function obtenerHistorial(string $mensajeActual): array
    {
        $historial = [];
        foreach ($this->mensajes as $msg) {
            if ($msg['rol'] === 'usuario') {
                $historial[] = ['role' => 'user', 'content' => $msg['texto']];
            } else {
                $historial[] = ['role' => 'assistant', 'content' => $msg['texto']];
            }
        }
        return $historial;
    }

    private function obtenerContexto(): string
    {
        $user = Auth::user();

        $sistema  = "Eres el asistente virtual de Comadreja Shop, una tienda en linea.\n";
        $sistema .= "Responde siempre en español, de forma formal, clara y ordenada.\n";
        $sistema .= "Cuando presentes informacion de pedidos, usa este formato exacto:\n";
        $sistema .= "Pedido #ORD-X\n";
        $sistema .= "  Estado: [estado]\n";
        $sistema .= "  Total: $[monto]\n";
        $sistema .= "  Productos: [lista de productos]\n";
        $sistema .= "Sin asteriscos ni markdown. Solo da detalles cuando el usuario los pida.\n";
        $sistema .= "\nUsuario: {$user->name}. Rol: {$user->role}.\n";

        if ($user->role === 'comprador') {
            $pedidos = Order::where('user_id', $user->id)->with('items.product')->latest()->get();
            $sistema .= "Total de pedidos del cliente: " . $pedidos->count() . "\n";
            foreach ($pedidos as $pedido) {
                $prods = $pedido->items->map(fn($i) => $i->product->name)->join(', ');
                $sistema .= "Pedido #ORD-{$pedido->id}: estado {$pedido->status}, total \${$pedido->total}, productos: {$prods}\n";
            }
            $disponibles = Product::where('active', true)->latest()->take(5)->get();
            $sistema .= "\nProductos disponibles en tienda:\n";
            foreach ($disponibles as $p) {
                $sistema .= "- {$p->name}: \${$p->price}, stock disponible: {$p->stock}\n";
            }
        } elseif ($user->role === 'vendedor') {
            $misProductos = $user->products()->latest()->get();
            $sistema .= "\nProductos publicados por el vendedor:\n";
            foreach ($misProductos as $p) {
                $sistema .= "- {$p->name}: precio \${$p->price}, stock: {$p->stock}\n";
            }
            $ids = $user->products()->pluck('id');
            $pedidos = Order::whereHas('items', function($q) use ($ids) {
                $q->whereIn('product_id', $ids);
            })->with('items.product', 'user')->latest()->get();
            $sistema .= "\nTotal pedidos recibidos: " . $pedidos->count() . "\n";
            foreach ($pedidos as $pedido) {
                $prods = $pedido->items->map(fn($i) => $i->product->name)->join(', ');
                $sistema .= "Pedido #ORD-{$pedido->id}: cliente {$pedido->user->name}, estado {$pedido->status}, total \${$pedido->total}, productos: {$prods}\n";
            }
        }

        return $sistema;
    }

    public function render()
    {
        return view('livewire.chatbot.chat-flotante');
    }
}
