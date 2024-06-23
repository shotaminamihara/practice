<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Company;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class Product_updateController extends Controller
{
   

    public function showProducts_update(Request $request,$id) {
        $product = Product::findOrFail($id);
        $company = Company::find($product->company_id);
        $sale = Sale::where('product_id', $id)->get();
        $product->product_name = $request->product_name;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->comment = $request->comment;
        $product->img_path = $request->img_path;
        if ($request->has('company_id')) {
            $product->company_id = $request->company_id;
        }
        
        $product->save();

        return redirect()->route('products_list');
    }
}
