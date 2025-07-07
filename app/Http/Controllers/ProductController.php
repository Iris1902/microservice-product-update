<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // Update product by ID
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'price' => 'sometimes|numeric',
            'image_url' => 'sometimes|url',
        ]);

        $product->update($validated);

        return response()->json(['message' => 'Product updated successfully', 'data' => $product]);
    }
    
    // Health check endpoint
    public function healthCheck()
    {
        return response()->json(['status' => 'ok', 'message' => 'Service is running']);
    }
}