{{-- Sidebar desktop --}}
<aside class="hidden md:block w-52 min-h-screen pt-4 px-2" style="background-color: white; border-right: 1px solid #E5E7EB;">
    <ul class="space-y-1">
        <li>
            <a href="/catalog" class="flex items-center gap-3 px-4 py-2 rounded-lg text-sm {{ request()->is('catalog') && !request()->is('catalog/*') ? 'font-medium' : '' }}"
                style="{{ request()->is('catalog') && !request()->is('catalog/*') ? 'background-color:#F0FAF6;' : '' }} color:#111827;">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                Inicio
            </a>
        </li>
        <li>
            <a href="/cart" class="flex items-center gap-3 px-4 py-2 rounded-lg text-sm {{ request()->is('cart') ? 'font-medium' : '' }}"
                style="{{ request()->is('cart') ? 'background-color:#F0FAF6;' : '' }} color:#111827;">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.5 6h13M10 21a1 1 0 1 0 2 0M17 21a1 1 0 1 0 2 0"/>
                </svg>
                Mi Carrito
            </a>
        </li>
        <li>
            <a href="/orders" class="flex items-center gap-3 px-4 py-2 rounded-lg text-sm {{ request()->is('orders') ? 'font-medium' : '' }}"
                style="{{ request()->is('orders') ? 'background-color:#F0FAF6;' : '' }} color:#111827;">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                Mis Pedidos
            </a>
        </li>
        <li>
            <a href="/profile" class="flex items-center gap-3 px-4 py-2 rounded-lg text-sm {{ request()->is('profile*') ? 'font-medium' : '' }}"
                style="{{ request()->is('profile*') ? 'background-color:#F0FAF6;' : '' }} color:#111827;">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                Mi Perfil
            </a>
        </li>
    </ul>
</aside>

{{-- Menu inferior movil --}}
<div class="md:hidden fixed bottom-0 left-0 right-0 z-40 flex justify-around py-2 px-4" style="background:white; border-top:1px solid #E5E7EB;">
    <a href="/catalog" class="flex flex-col items-center gap-1" style="color:{{ request()->is('catalog') ? '#2563EB' : '#6B7280' }};">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
        </svg>
        <span class="text-xs">Inicio</span>
    </a>
    <a href="/cart" class="flex flex-col items-center gap-1" style="color:{{ request()->is('cart') ? '#2563EB' : '#6B7280' }};">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.5 6h13M10 21a1 1 0 1 0 2 0M17 21a1 1 0 1 0 2 0"/>
        </svg>
        <span class="text-xs">Carrito</span>
    </a>
    <a href="/orders" class="flex flex-col items-center gap-1" style="color:{{ request()->is('orders') ? '#2563EB' : '#6B7280' }};">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
        </svg>
        <span class="text-xs">Pedidos</span>
    </a>
    <a href="/profile" class="flex flex-col items-center gap-1" style="color:{{ request()->is('profile*') ? '#2563EB' : '#6B7280' }};">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
        </svg>
        <span class="text-xs">Perfil</span>
    </a>
</div>
