<?php

use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Models\Category;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::get('/products', function () {
    return Product::with('category', 'user')->get();
});

Route::get('/products/{id}', function ($id) {
    return Product::with('category', 'user')->findOrFail($id);
});

Route::get('/categories', function () {
    return Category::all();
});