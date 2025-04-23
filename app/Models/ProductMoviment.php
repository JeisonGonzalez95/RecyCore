<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductMoviment extends Model
{
    use HasFactory;

    protected $table = 'products_moviments';

    protected $fillable = ['id_moviment_in', 'id_moviment_out', 'id_product', 'amount_kg', 'price_product'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product');
    }

    public function movimentIn()
    {
        return $this->belongsTo(MovimentsIn::class, 'id_moviment_in');
    }

    public function movimentOut()
    {
        return $this->belongsTo(MovimentsOut::class, 'id_moviment_out');
    }
}
