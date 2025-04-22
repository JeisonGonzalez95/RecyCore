<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventaryOut extends Model
{
    use HasFactory;

    protected $table = 'inventary_out';

    protected $fillable = ['product_id', 'employee_id', 'amount_kg', 'description', 'date_out', 'state'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
