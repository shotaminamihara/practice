<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    public function getProducts_list() {
        // productsテーブルからデータを取得
        $products = DB::table('products')->get();
        return $products;
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function sale(){
        return $this->hasMany(Sale::class);
    }
}
