<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class users_app extends Authenticatable
{
    protected $table = 'users_app'; // Especificar el nombre correcto de la tabla
    protected $fillable = ['fullname', 'dni', 'email', 'username', 'password', 'remember_token', 'state'];
}

