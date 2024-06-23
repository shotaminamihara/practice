<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Company;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;

class Product_listController extends Controller
{
    public function showProducts_list() {
        $companies = DB::table('companies')->get();
        $products = DB::table('products')
            ->join('companies','products.company_id','=','companies.id')
            ->select('products.*','companies.company_name as company_name')
            ->get();

        return view('products_list',compact('products','companies'));
    }
    public function showProducts_search(Request $request){
        $companies = DB::table('companies')->get();
        $product_keyword = $request->input('searchbox');
        $company_select = $request->input('selectbox');
        $products = DB::table('products')
            ->join('companies','products.company_id','=','companies.id')
            ->select('products.*','companies.company_name')
            ->where('companies.company_name','like','%'.$company_select.'%')
            ->where('products.product_name','like','%'.$product_keyword.'%')
            ->get();
        return view('products_list',compact('products','companies'));
    
    }
    
    public function showProducts_registration() {
        $companies = DB::table('companies')->get();


        return view('products_registration', compact('companies'));
    }

    public function showProducts_delete($id) {
        $product = Product::findOrFail($id);
        $rowCount = $product->rowCount;
        $product->delete();

        $sale = Sale::where('product_id',$id)->first();
        if($sale){
            $sale->delete();
        }

        return redirect()->route('products_list');
    }
}
