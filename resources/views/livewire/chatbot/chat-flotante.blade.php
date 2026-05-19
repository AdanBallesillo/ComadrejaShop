<div>
    {{-- Botón flotante --}}
    <button wire:click="toggle"
        class="fixed bottom-20 md:bottom-6 right-4 md:right-6 w-12 h-12 md:w-14 md:h-14 rounded-full text-white flex items-center justify-center shadow-lg z-50"
        style="background-color:#B9EBD7;">
        @if($abierto)
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="#0F6B3A">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        @else
            {{-- Logo comadreja SVG --}}
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" class="h-8 w-8">
                {{-- Cuerpo --}}
                <ellipse cx="32" cy="38" rx="16" ry="12" fill="#0F6B3A"/>
                {{-- Cabeza --}}
                <circle cx="32" cy="22" r="10" fill="#0F6B3A"/>
                {{-- Orejas --}}
                <ellipse cx="24" cy="14" rx="4" ry="6" fill="#0F6B3A"/>
                <ellipse cx="40" cy="14" rx="4" ry="6" fill="#0F6B3A"/>
                {{-- Franja blanca cara --}}
                <ellipse cx="32" cy="24" rx="5" ry="7" fill="white"/>
                {{-- Ojos --}}
                <circle cx="29" cy="20" r="2" fill="#0F6B3A"/>
                <circle cx="35" cy="20" r="2" fill="#0F6B3A"/>
                {{-- Nariz --}}
                <ellipse cx="32" cy="25" rx="2" ry="1.5" fill="#0F6B3A"/>
                {{-- Cola --}}
                <path d="M48 42 Q58 35 56 48 Q50 52 48 44" fill="#0F6B3A"/>
            </svg>
        @endif
    </button>

    @if($abierto)
    {{-- Movil --}}
    <div class="md:hidden fixed inset-x-0 bottom-16 shadow-xl flex flex-col overflow-hidden z-50"
        style="height:70vh; border-top-left-radius:20px; border-top-right-radius:20px; border:1px solid #9DD4C0; background-color:white;">
        <div class="px-4 py-3 flex items-center gap-3 flex-shrink-0" style="background-color:#B9EBD7;">
            <div class="w-10 h-10 rounded-full flex items-center justify-center" style="background-color:white;">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" class="h-8 w-8">
                    <ellipse cx="32" cy="38" rx="16" ry="12" fill="#0F6B3A"/>
                    <circle cx="32" cy="22" r="10" fill="#0F6B3A"/>
                    <ellipse cx="24" cy="14" rx="4" ry="6" fill="#0F6B3A"/>
                    <ellipse cx="40" cy="14" rx="4" ry="6" fill="#0F6B3A"/>
                    <ellipse cx="32" cy="24" rx="5" ry="7" fill="white"/>
                    <circle cx="29" cy="20" r="2" fill="#0F6B3A"/>
                    <circle cx="35" cy="20" r="2" fill="#0F6B3A"/>
                    <ellipse cx="32" cy="25" rx="2" ry="1.5" fill="#0F6B3A"/>
                    <path d="M48 42 Q58 35 56 48 Q50 52 48 44" fill="#0F6B3A"/>
                </svg>
            </div>
            <div class="flex-1">
                <p class="text-sm font-bold" style="color:#0F6B3A;">Asistente Comadreja</p>
                <p class="text-xs" style="color:#0F6B3A;">En linea</p>
            </div>
            <button wire:click="toggle" style="color:#0F6B3A;">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <div class="flex-1 overflow-y-auto p-4 space-y-3">
            @if(empty($mensajes))
                <div class="text-center py-4">
                    <p class="text-sm font-medium mb-1" style="color:#111827;">Hola, {{ auth()->user()->name }}! 👋</p>
                    @if(auth()->user()->role === 'comprador')
                        <p class="text-xs" style="color:#6B7280;">Puedo ayudarte con tus pedidos y recomendarte productos.</p>
                    @else
                        <p class="text-xs" style="color:#6B7280;">Puedo ayudarte con pedidos pendientes y descripciones.</p>
                    @endif
                </div>
            @endif
            @foreach($mensajes as $msg)
                @if($msg['rol'] === 'usuario')
                    <div class="flex justify-end">
                        <div class="max-w-xs px-3 py-2 rounded-xl text-sm text-white" style="background-color:#2563EB;">{{ $msg['texto'] }}</div>
                    </div>
                @else
                    <div class="flex justify-start gap-2">
                        <div class="w-6 h-6 rounded-full flex-shrink-0 flex items-center justify-center" style="background-color:#B9EBD7;">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" class="h-4 w-4">
                                <ellipse cx="32" cy="38" rx="16" ry="12" fill="#0F6B3A"/>
                                <circle cx="32" cy="22" r="10" fill="#0F6B3A"/>
                                <ellipse cx="24" cy="14" rx="4" ry="6" fill="#0F6B3A"/>
                                <ellipse cx="40" cy="14" rx="4" ry="6" fill="#0F6B3A"/>
                                <ellipse cx="32" cy="24" rx="5" ry="7" fill="white"/>
                                <circle cx="29" cy="20" r="2" fill="#0F6B3A"/>
                                <circle cx="35" cy="20" r="2" fill="#0F6B3A"/>
                            </svg>
                        </div>
                        <div class="max-w-xs px-3 py-2 rounded-xl text-sm" style="background-color:#F0FAF6; color:#111827; border:1px solid #B9EBD7;">{{ $msg['texto'] }}</div>
                    </div>
                @endif
            @endforeach
            @if($cargando)
                <div class="flex justify-start gap-2">
                    <div class="w-6 h-6 rounded-full flex-shrink-0 flex items-center justify-center" style="background-color:#B9EBD7;">
                    </div>
                    <div class="px-3 py-2 rounded-xl text-sm" style="background-color:#F0FAF6; color:#6B7280; border:1px solid #B9EBD7;">Escribiendo...</div>
                </div>
            @endif
        </div>
        <div class="p-3 flex-shrink-0" style="border-top:1px solid #B9EBD7;">
            <div class="flex gap-2">
                <input wire:model="mensaje" wire:keydown.enter="enviarMensaje" type="text" placeholder="Escribe tu pregunta..."
                    class="flex-1 px-3 py-2 text-sm outline-none rounded-lg"
                    style="border:1px solid #B9EBD7; color:#111827; background:#F9FAFB;">
                <button wire:click="enviarMensaje" class="px-3 py-2 rounded-lg" style="background-color:#B9EBD7;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="#0F6B3A">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Desktop --}}
    <div class="hidden md:flex fixed flex-col overflow-hidden shadow-xl rounded-xl z-50"
        style="bottom:96px; right:24px; width:320px; height:420px; border:1px solid #9DD4C0; background-color:white;">
        <div class="px-4 py-3 flex items-center gap-3 flex-shrink-0" style="background-color:#B9EBD7;">
            <div class="w-10 h-10 rounded-full flex items-center justify-center" style="background-color:white;">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" class="h-8 w-8">
                    <ellipse cx="32" cy="38" rx="16" ry="12" fill="#0F6B3A"/>
                    <circle cx="32" cy="22" r="10" fill="#0F6B3A"/>
                    <ellipse cx="24" cy="14" rx="4" ry="6" fill="#0F6B3A"/>
                    <ellipse cx="40" cy="14" rx="4" ry="6" fill="#0F6B3A"/>
                    <ellipse cx="32" cy="24" rx="5" ry="7" fill="white"/>
                    <circle cx="29" cy="20" r="2" fill="#0F6B3A"/>
                    <circle cx="35" cy="20" r="2" fill="#0F6B3A"/>
                    <ellipse cx="32" cy="25" rx="2" ry="1.5" fill="#0F6B3A"/>
                    <path d="M48 42 Q58 35 56 48 Q50 52 48 44" fill="#0F6B3A"/>
                </svg>
            </div>
            <div>
                <p class="text-sm font-bold" style="color:#0F6B3A;">Asistente Comadreja</p>
                <p class="text-xs" style="color:#0F6B3A;">En linea</p>
            </div>
        </div>
        <div class="flex-1 overflow-y-auto p-4 space-y-3" id="chat-desktop">
            @if(empty($mensajes))
                <div class="text-center py-4">
                    <p class="text-sm font-medium mb-1" style="color:#111827;">Hola, {{ auth()->user()->name }}! 👋</p>
                    @if(auth()->user()->role === 'comprador')
                        <p class="text-xs" style="color:#6B7280;">Puedo ayudarte con tus pedidos y recomendarte productos.</p>
                    @else
                        <p class="text-xs" style="color:#6B7280;">Puedo ayudarte con pedidos pendientes y descripciones.</p>
                    @endif
                </div>
            @endif
            @foreach($mensajes as $msg)
                @if($msg['rol'] === 'usuario')
                    <div class="flex justify-end">
                        <div class="max-w-xs px-3 py-2 rounded-xl text-sm text-white" style="background-color:#2563EB;">{{ $msg['texto'] }}</div>
                    </div>
                @else
                    <div class="flex justify-start gap-2">
                        <div class="w-6 h-6 rounded-full flex-shrink-0 flex items-center justify-center" style="background-color:#B9EBD7;">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" class="h-4 w-4">
                                <ellipse cx="32" cy="38" rx="16" ry="12" fill="#0F6B3A"/>
                                <circle cx="32" cy="22" r="10" fill="#0F6B3A"/>
                                <ellipse cx="24" cy="14" rx="4" ry="6" fill="#0F6B3A"/>
                                <ellipse cx="40" cy="14" rx="4" ry="6" fill="#0F6B3A"/>
                                <ellipse cx="32" cy="24" rx="5" ry="7" fill="white"/>
                                <circle cx="29" cy="20" r="2" fill="#0F6B3A"/>
                                <circle cx="35" cy="20" r="2" fill="#0F6B3A"/>
                            </svg>
                        </div>
                        <div class="max-w-xs px-3 py-2 rounded-xl text-sm" style="background-color:#F0FAF6; color:#111827; border:1px solid #B9EBD7;">{{ $msg['texto'] }}</div>
                    </div>
                @endif
            @endforeach
            @if($cargando)
                <div class="flex justify-start gap-2">
                    <div class="w-6 h-6 rounded-full flex-shrink-0" style="background-color:#B9EBD7;"></div>
                    <div class="px-3 py-2 rounded-xl text-sm" style="background-color:#F0FAF6; color:#6B7280; border:1px solid #B9EBD7;">Escribiendo...</div>
                </div>
            @endif
        </div>
        <div class="p-3 flex-shrink-0" style="border-top:1px solid #B9EBD7;">
            <div class="flex gap-2">
                <input wire:model="mensaje" wire:keydown.enter="enviarMensaje" type="text" placeholder="Escribe tu pregunta..."
                    class="flex-1 px-3 py-2 text-sm outline-none rounded-lg"
                    style="border:1px solid #B9EBD7; color:#111827; background:#F9FAFB;">
                <button wire:click="enviarMensaje" class="px-3 py-2 rounded-lg" style="background-color:#B9EBD7;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="#0F6B3A">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
    @endif
</div>
