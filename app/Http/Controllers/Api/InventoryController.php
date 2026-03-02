<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Http\Controllers\Controller;

class InventoryController extends Controller
{
    // GET /inventory/value
    public function totalValue()
    {
        $totalValue = Product::selectRaw('SUM(price * stock_quantity) as total_inventory_value')
            ->value('total_inventory_value');

        return response()->json([
            'total_inventory_value' => $totalValue ?? 0
        ], 200);
    }
}