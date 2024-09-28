<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Resources\ProductResource;
class ProductController extends Controller
{
    public function index()
    {
        return ProductResource::collection(Product::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
        ]);

        $product = Product::create($validated);

        return new ProductResource($product);
    }

    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
        ]);

        $product->update($validated);

        return new ProductResource($product);
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return response()->noContent();
    }
}
