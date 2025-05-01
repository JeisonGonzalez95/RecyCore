<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collector extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type_dni', 'dni', 'country', 'phone', 'email', 'address', 'state'];

    public function type()
    {
        return $this->belongsTo(docTypes::class, 'type_dni', 'id');
    }
}
