<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['fullname', 'dni', 'email', 'phone', 'area_id', 'rol_id', 'state'];

    public function rol()
    {
        return $this->belongsTo(EmployeeRole::class);
    }

    public function area()
    {
        return $this->belongsTo(EmployeeArea::class);
    }

    public function userApp()
    {
        return $this->hasOne(users_app::class, 'dni', 'dni');
    }
}
