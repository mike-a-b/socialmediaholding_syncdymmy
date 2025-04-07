<?php

use Illuminate\Support\Facades\Route;
use Faker\Factory;
use App\Http\Controllers\ProductSyncController;

Route::get('/sync/products', [ProductSyncController::class, 'syncProducts']);
Route::get('/products', [ProductSyncController::class, 'getProducts']);

Route::get('/', function () {
    return view('welcome');
});
