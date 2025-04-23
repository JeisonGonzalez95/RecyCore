<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovimentsOut extends Model
{
    use HasFactory;

    protected $table = 'moviments_out';

    protected $fillable = ['name_client', 'employee_id', 'date_out', 'description'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
    
    public function product_moviment()
    {
        return $this->belongsTo(ProductMoviment::class);
    }
}
