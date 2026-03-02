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

    $result = $products->map(function ($product) {
    $finalPrice = $product->price - ($product->price * $product->discount / 100);

        return [
            'name' => $product->name,
            'price' => $product->price,
            'discount' => $product->discount,
            'final_price' => $finalPrice,
            'category' => $product->category->name
        ];
    });

    return response()->json($result, 200);
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

    return response()->json([
        'id' => $product->id,
        'name' => $product->name,
        'price' => $product->price,
        'stock_quantity' => $product->stock_quantity,
        'discount' => $product->discount,
        'category' => $product->category->name,
        'created_at' => $product->created_at,
        'updated_at' => $product->updated_at,
    ], 200);
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
    $query = Product::with('category');

    //filter by id
    if ($request->id) {
        $query->where('id', $request->id);
    }

    // filter by name
    if ($request->name) {
        $query->where('name', 'like', '%' . $request->name . '%');
    }

    // filter by category
    if ($request->category_id) {
        $query->where('category_id', $request->category_id);
    }

    $products = $query->get();

    // format output
    $result = $products->map(function ($product) {
        return [
            'name' => $product->name,
            'price' => $product->price,
            'discount' => $product->discount,
            'final_price' => $product->final_price,
            'category' => $product->category->name
        ];
    });

    return response()->json($result);
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

    //set diskon
    public function setDiscount(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'discount' => 'required|integer|min:0|max:100'
        ]);

        $product = Product::findOrFail($request->product_id);

        $product->update([
            'discount' => $request->discount
        ]);

        return response()->json([
            'message' => 'Diskon berhasil diterapkan',
            'data' => $product
        ], 200);
    }

    //remove diskon
    public function removeDiscount(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        $product = Product::findOrFail($request->product_id);

        $product->update([
            'discount' => 0
        ]);

        return response()->json([
            'message' => 'Diskon dihapus',
            'data' => $product
        ], 200);
    }

}
