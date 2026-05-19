<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\Login;
use App\Livewire\Profile\EditProfile;
use App\Livewire\Profile\EditarPerfil;
use App\Livewire\Products\CreateProduct;
use App\Livewire\Products\ProductList;
use App\Livewire\Products\EditProduct;
use App\Livewire\Catalog\ProductCatalog;
use App\Livewire\Catalog\ProductDetail;
use App\Livewire\Cart\ShoppingCart;
use App\Livewire\Checkout\CheckoutForm;
use App\Livewire\Pedidos\MisPedidos;
use App\Livewire\Pedidos\PedidosVendedor;
use App\Livewire\Pedidos\DetallePedido;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/register', Register::class)->name('register');
Route::get('/login', Login::class)->name('login');

Route::post('/logout', function () {
    auth()->logout();
    return redirect('/login');
})->name('logout');

// Catalogo publico
Route::get('/catalog', ProductCatalog::class)->name('catalog');
Route::get('/catalog/{product}', ProductDetail::class)->name('catalog.show');

Route::middleware('auth')->group(function () {

    // Dashboard - redirige segun rol
    Route::get('/dashboard', function () {
        $role = auth()->user()->role;
        if ($role === 'admin') {
            return redirect('/admin');
        } elseif ($role === 'vendedor') {
            return redirect('/vendor/dashboard');
        }
        return redirect('/catalog');
    })->name('dashboard');

    // Perfil para todos los roles
    Route::get('/profile', EditProfile::class)->name('profile');
    Route::get('/profile/edit', EditarPerfil::class)->name('profile.edit');

    // Rutas solo para comprador
    Route::middleware('rol:comprador')->group(function () {
        Route::get('/cart', ShoppingCart::class)->name('cart');
        Route::get('/checkout', CheckoutForm::class)->name('checkout');
        Route::get('/checkout/confirm', function () {
            return view('checkout-confirm');
        })->name('checkout.confirm');
        Route::get('/orders', MisPedidos::class)->name('orders');
    });

    // Rutas solo para vendedor
    Route::middleware('rol:vendedor')->group(function () {
        Route::get('/products', ProductList::class)->name('products.index');
        Route::get('/products/create', CreateProduct::class)->name('products.create');
        Route::get('/products/{product}/edit', EditProduct::class)->name('products.edit');
        Route::get('/vendor/orders', PedidosVendedor::class)->name('vendor.orders');
        Route::get('/vendor/orders/{pedido}', DetallePedido::class)->name('vendor.orders.show');
    });
});

Route::get('/vendor/dashboard', function () {
    return view('dashboard-vendedor');
})->middleware(['auth', 'rol:vendedor'])->name('vendor.dashboard');
