<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        $request = $request->all();

        $product = Product::create($request);

        return response()->json([
            'data' => $product,
            'message' => 'Item is added successfully'
        ]);
    }

    public function index()
    {
        $products = Product::all();

        return response()->json([
            'data' => $products
        ]);
    }

    public function show(Product $product)
    {
        return response()->json([
            'data' => $product
        ]);
    }

    public function delete(Product $product)
    {
        $product->delete();

        return response()->json([
            'message' => 'Item deleted successfully'
        ]);
    }
}
