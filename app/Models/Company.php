<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Company extends Model
{
    protected $table = 'companies';

    public function products(){
        return $this->hasMany(Product::class);
    }
    
}