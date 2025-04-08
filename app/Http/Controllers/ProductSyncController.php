<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Product;

class ProductSyncController extends Controller
{
    public function syncProducts()
    {
        $response = Http::timeout(20)->get('https://dummyjson.com/products/search?q=iphone');
        if (!$response->successful()) {
            return response()->json(['error' => 'Failed to fetch from API'], 500);
        }

        $products = $response->json()['products'];

        foreach ($products as $item) {
//            dd($item);
            Product::updateOrCreate(
                ['external_id' => $item['id'], 'type' => 'product'],
                [
                    'type' => 'product',
                    'title' => $item['title'],
                    'description' => $item['description'],
                    'price' => $item['price'],
                    'brand' => $item['brand'],
                ]
            );
        }

        return response()->json(['message' => 'Products synced', 'count' => count($products)]);
    }

    public function getProducts()
    {
        return Product::where('type', 'product')->get();
    }
}
