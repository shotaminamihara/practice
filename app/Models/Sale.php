<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table = 'sales';
    protected $dates = ['created_at', 'updated_at'];
    protected $fillable = ['id', 'product_id'];

    public function sales() {
        return $this->belongsTo(Product::class);
    }
}
