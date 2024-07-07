<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    public function getList() {
        $sales = DB::table('sales')->get();

        return $this->belongsTo(Product::class);
    }
}
