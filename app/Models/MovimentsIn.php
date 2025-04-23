<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovimentsIn extends Model
{
    use HasFactory;

    protected $table = 'moviments_in';

    protected $fillable = ['name_client', 'employee_id', 'date_in', 'description'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function products()
    {
        return $this->hasMany(ProductMoviment::class, 'id_moviment_in');
    }
}
