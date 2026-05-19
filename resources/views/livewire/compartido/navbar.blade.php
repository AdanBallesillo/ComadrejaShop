@include('partials.navbar') <div style="display:none">
    <a href="/catalog">
        <h1 class="text-lg font-bold" style="color: #111827;">Comadreja Shop</h1>
    </a>
    <div class="flex-1 mx-6">
        <div class="flex items-center" style="background:white; border-radius:10px; border:1px solid #9DD4C0; padding: 6px 14px; max-width: 400px;">
            <input wire:model="busqueda" wire:keydown.enter="buscar" type="text" placeholder="Buscar productos..."
                class="outline-none text-sm w-full" style="color:#111827; background:transparent;">
            <button wire:click="buscar">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="#6B7280">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/>
                </svg>
            </button>
        </div>
    </div>
    <div class="flex items-center gap-3">
        {{-- Carrito --}}
        <a href="/cart" class="relative">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="#111827">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.5 6h13M10 21a1 1 0 1 0 2 0M17 21a1 1 0 1 0 2 0"/>
            </svg>
            @if($totalCarrito > 0)
                <span class="absolute -top-2 -right-2 w-4 h-4 rounded-full text-white text-xs flex items-center justify-center"
                    style="background-color:#2563EB; font-size:10px;">{{ $totalCarrito }}</span>
            @endif
        </a>
        {{-- Perfil --}}
        <a href="/profile">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="#111827">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
        </a>
        @auth
            <span class="text-sm font-medium" style="color:#111827;">{{ auth()->user()->name }}</span>
            {{-- Cerrar sesion --}}
            <form method="POST" action="/logout">
                @csrf
                <button type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="#111827">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v1"/>
                    </svg>
                </button>
            </form>
        @else
            <a href="/login" class="text-sm px-4 py-1 rounded-lg text-white" style="background-color:#2563EB;">Iniciar sesion</a>
            <a href="/register" class="text-sm px-4 py-1 rounded-lg" style="border:1px solid #111827; color:#111827;">Registrarse</a>
        @endauth
    </div>
</nav>
