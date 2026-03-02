<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    // GET /products
    public function index()
    {
        $products = Product::with('category')->get();

        return response()->json($products, 200);
    }

    // POST /products
    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->validated());

        return response()->json($product, 201);
    }

    // GET /products/{id}
    public function show(string $id)
    {
        $product = Product::with('category')->findOrFail($id);

        return response()->json($product, 200);
    }

    // PUT /products/{id}
    public function update(UpdateProductRequest $request, string $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->validated());

        return response()->json($product, 200);
    }

    // DELETE /products/{id}
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json([
            'message' => 'Produk berhasil dihapus'
        ], 200);
    }

    // GET /products/search
    public function search(Request $request)
    {
        $query = Product::query();

        if ($request->name) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        $products = $query->with('category')->get();

        return response()->json($products, 200);
    }

    // POST /products/update-stock
    public function updateStock(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'stock_quantity' => 'required|integer|min:0'
        ]);

        $product = Product::findOrFail($request->product_id);
        $product->update([
            'stock_quantity' => $request->stock_quantity
        ]);

        return response()->json($product, 200);
    }
}
