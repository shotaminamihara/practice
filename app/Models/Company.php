<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Company extends Model
{
    public function getProducts_list() {
        // companiesテーブルからデータを取得
        $companies = DB::table('companies')->get();
        return $companies;
    }
    public function products(){
        return $this->hasMany(Product::class);
    }
}