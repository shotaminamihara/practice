<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class Product_registrationController extends Controller
{
    public function showProducts_registration(Request $request) {
        $rules = [
            'product_name' => 'required',
            'company_name' => 'required',
            'price' => 'required',
            'stock' => 'required',
        ];
        $validatedData = $request->validate($rules);
    
        $product = new Product;
        $product->product_name = $request->product_name;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->comment = $request->comment;
        $product->img_path = $request->img_path;
        $product->company_id = $request->company_name;
        
        $product->save();
        
        return redirect()->route('products_list');
    }


}
