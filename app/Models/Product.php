<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    protected $table = 'products';
    protected $dates = ['created_at', 'updated_at'];
    protected $fillable = ['id', 'company_id', 'product_name', 'price', 'stock', 'comment', 'img_path'];


    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function sale(){
        return $this->hasMany(Sale::class);
    }

    public function getCompanies(){
    return DB::table('companies')
        ->select('id', 'company_name')
        ->get();
    }

    public function getProducts_list(){
        $companies = $this->getCompanies();
        $products = DB::table('products')
            ->join('companies', 'company_id', '=', 'companies.id')
            ->select('products.*','companies.company_name')
            ->get();

        return compact('products', 'companies');
    }

    public function getProducts_search($searchbox, $selectbox,$priceMin,$priceMax,$stockMin,$stockMax,$request){
        $companies = $this->getCompanies();
        $products = DB::table('products')
            ->join('companies','company_id','=','companies.id')
            ->select('products.*','companies.company_name')
            ->where('companies.company_name','like','%'.$selectbox.'%')
            ->where('products.product_name','like','%'.$searchbox.'%')
            ->when($priceMin, function ($query, $priceMin) {
                return $query->where('products.price', '>=', $priceMin);
            })
            ->when($priceMax, function ($query, $priceMax) {
                return $query->where('products.price', '<=', $priceMax);
            })
            ->when($stockMin, function ($query, $stockMin) {
                return $query->where('products.stock', '>=', $stockMin);
            })
            ->when($stockMax, function ($query, $stockMax) {
                return $query->where('products.stock', '<=', $stockMax);
            })
            ->get();

        return compact('products','companies');
    }   
    
    
}
