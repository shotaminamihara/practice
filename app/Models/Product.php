<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    protected $table = 'products';

    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function sale(){
        return $this->hasMany(Sale::class);
    }

    public function getProducts_list()
    {
        $companies = DB::table('companies')
            ->select('id','company_name')
            ->get();
        $products = DB::table('products')
            ->join('companies', 'company_id', '=', 'companies.id')
            ->select('products.*', 'companies.company_name')
            ->get();

        return compact('products', 'companies');
    }

    public function getProducts_search($searchbox, $selectbox,$request){
        $companies = DB::table('companies')
            ->select('id','company_name')
            ->get();
        $searchbox = $request->input('searchbox');
        $selectbox = $request->input('selectbox');
        $products = DB::table('products')
            ->join('companies','company_id','=','companies.id')
            ->select('products.*','companies.company_name')
            ->where('companies.company_name','like','%'.$selectbox.'%')
            ->where('products.product_name','like','%'.$searchbox.'%')
            ->get();

        return compact('products','companies');
    }    
}
