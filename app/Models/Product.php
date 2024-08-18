<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $categorias = [];


    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product', 'product_id', 'category_id');
    }
    
    public function sales ()
    {
        return $this->belongsToMany(Sale::class, 'product_sale', 'product_id', 'sale_id');
    }
}
