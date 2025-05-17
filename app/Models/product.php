<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;

    protected $fillable = ['product_name', 'slug_product', 'price_product_sale', 'price_product_purch_f', 'price_product_purch_c', 'state'];
}
