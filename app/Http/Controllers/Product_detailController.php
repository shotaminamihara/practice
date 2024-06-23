<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Company;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;

class Product_detailController extends Controller
{
    public function showProducts_detail($id) {
        $product = Product::find($id);
        $company = Company::find($product->company_id);
        $sale = Sale::where('product_id', $id)->get();

        return view('products_detail', compact('product', 'company', 'sale'));
    }
    
    public function showProducts_edit($id){
        $product = Product::find($id);
        return view('products_update',compact('product'));
    }
    

}