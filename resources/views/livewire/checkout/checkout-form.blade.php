<div class="min-h-screen" style="background-color: #F9FAFB; font-family: 'Inter', sans-serif;">

    @include('partials.navbar')

    <main class="max-w-4xl mx-auto px-4 md:px-8 py-6 md:py-10 pb-20 md:pb-10">
        <h2 class="text-xl font-bold mb-4" style="color:#111827;">Checkout</h2>

        <div class="flex items-center gap-3 mb-6">
            <div class="flex items-center gap-2">
                <div class="w-7 h-7 rounded-full flex items-center justify-center text-sm font-bold"
                    style="{{ $step == 1 ? 'background-color:#2563EB; color:white;' : 'background-color:#B9EBD7; color:#111827;' }}">1</div>
                <span class="text-xs md:text-sm font-medium" style="color:#111827;">Envio</span>
            </div>
            <div class="flex-1 h-px" style="background:#E5E7EB;"></div>
            <div class="flex items-center gap-2">
                <div class="w-7 h-7 rounded-full flex items-center justify-center text-sm font-bold"
                    style="{{ $step == 2 ? 'background-color:#2563EB; color:white;' : 'background-color:#E5E7EB; color:#6B7280;' }}">2</div>
                <span class="text-xs md:text-sm" style="color:#{{ $step == 2 ? '111827' : '6B7280' }};">Pago</span>
            </div>
        </div>

        <div class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                @if($step == 1)
                <div class="bg-white rounded-xl p-4 md:p-6" style="border:1px solid #E5E7EB;">
                    <h3 class="font-bold mb-4" style="color:#111827;">Datos de Envio</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm mb-1" style="color:#111827;">Nombre del destinatario</label>
                            <input wire:model="shipping_name" type="text" placeholder="Nombre completo"
                                class="w-full px-3 py-2 text-sm outline-none"
                                style="border:1px solid #D1D5DB; border-radius:6px; color:#111827;">
                            @error('shipping_name') <p class="text-xs mt-1" style="color:#EF4444;">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm mb-1" style="color:#111827;">Direccion</label>
                            <input wire:model="shipping_address" type="text" placeholder="Calle, numero, colonia"
                                class="w-full px-3 py-2 text-sm outline-none"
                                style="border:1px solid #D1D5DB; border-radius:6px; color:#111827;">
                            @error('shipping_address') <p class="text-xs mt-1" style="color:#EF4444;">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm mb-1" style="color:#111827;">Telefono</label>
                            <input wire:model="shipping_phone" type="text" placeholder="Numero de contacto"
                                class="w-full px-3 py-2 text-sm outline-none"
                                style="border:1px solid #D1D5DB; border-radius:6px; color:#111827;">
                            @error('shipping_phone') <p class="text-xs mt-1" style="color:#EF4444;">{{ $message }}</p> @enderror
                        </div>
                        <div class="flex gap-3 pt-2">
                            <a href="/cart" class="flex-1 text-center px-4 py-2 text-sm rounded-lg" style="border:1px solid #D1D5DB; color:#111827;">Volver</a>
                            <button wire:click="nextStep" class="flex-1 px-4 py-2 text-white text-sm rounded-lg" style="background-color:#2563EB;">Continuar</button>
                        </div>
                    </div>
                </div>
                @endif

                @if($step == 2)
                <div class="bg-white rounded-xl p-4 md:p-6" style="border:1px solid #E5E7EB;">
                    <h3 class="font-bold mb-4" style="color:#111827;">Informacion de Pago</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm mb-1" style="color:#111827;">Numero de tarjeta</label>
                            <input wire:model="card_number" type="text" placeholder="1234567890123456" maxlength="16"
                                class="w-full px-3 py-2 text-sm outline-none"
                                style="border:1px solid #D1D5DB; border-radius:6px; color:#111827;">
                            @error('card_number') <p class="text-xs mt-1" style="color:#EF4444;">{{ $message }}</p> @enderror
                        </div>
                        <div class="flex gap-4">
                            <div class="flex-1">
                                <label class="block text-sm mb-1" style="color:#111827;">Vencimiento</label>
                                <input wire:model="card_expiry" type="text" placeholder="MM/AA"
                                    class="w-full px-3 py-2 text-sm outline-none"
                                    style="border:1px solid #D1D5DB; border-radius:6px; color:#111827;">
                                @error('card_expiry') <p class="text-xs mt-1" style="color:#EF4444;">{{ $message }}</p> @enderror
                            </div>
                            <div class="flex-1">
                                <label class="block text-sm mb-1" style="color:#111827;">CVV</label>
                                <input wire:model="card_cvv" type="text" placeholder="123" maxlength="4"
                                    class="w-full px-3 py-2 text-sm outline-none"
                                    style="border:1px solid #D1D5DB; border-radius:6px; color:#111827;">
                                @error('card_cvv') <p class="text-xs mt-1" style="color:#EF4444;">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        <div class="flex gap-3 pt-2">
                            <button wire:click="$set('step', 1)" class="flex-1 text-center px-4 py-2 text-sm rounded-lg" style="border:1px solid #D1D5DB; color:#111827;">Volver</button>
                            <button wire:click="placeOrder" class="flex-1 px-4 py-2 text-white text-sm rounded-lg" style="background-color:#2563EB;">Confirmar Compra</button>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <div class="w-full md:w-72 flex-shrink-0">
                <div class="bg-white rounded-xl p-4 md:p-6" style="border:1px solid #E5E7EB;">
                    <h3 class="font-bold mb-4" style="color:#111827;">Resumen</h3>
                    @foreach($items as $item)
                    <div class="flex justify-between text-sm mb-2" style="color:#6B7280;">
                        <span class="truncate mr-2">{{ $item->product->name }} x{{ $item->quantity }}</span>
                        <span class="flex-shrink-0">${{ number_format($item->product->price * $item->quantity, 2) }}</span>
                    </div>
                    @endforeach
                    <div class="border-t my-3" style="border-color:#E5E7EB;"></div>
                    <div class="flex justify-between font-bold" style="color:#111827;">
                        <span>Total</span>
                        <span>${{ number_format($total, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
