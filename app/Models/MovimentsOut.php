<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovimentsOut extends Model
{
    use HasFactory;

    protected $table = 'moviments_out';

    protected $fillable = ['id_provider', 'employee_id', 'date_out', 'description'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function provider()
    {
        return $this->belongsTo(provider::class);
    }
    public function products()
    {
        return $this->hasMany(ProductMoviment::class, 'id_moviment_out');
    }
    
    public function product_moviment()
    {
        return $this->belongsTo(ProductMoviment::class);
    }
}
