<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SalesController extends Controller
{
    public function purchase(Request $request){
    $productId = $request->input('product_id'); 
    $quantity = $request->input('quantity', 1); 
    $product = Product::find($productId); 
    if (!$product) {
        return response()->json(['message' => '商品が存在しません'], 404);
    }
    if ($product->stock < $quantity) {
        return response()->json(['message' => '商品が在庫不足です'], 400);
    }
    $product->stock -= $quantity; 
    $product->save();
    $sale = new Sale([
        'product_id' => $productId,
    ]);
    $sale->save();
    return response()->json(['message' => '購入成功']);
}
}
