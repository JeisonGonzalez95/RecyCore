<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class licence extends Model
{
    use HasFactory;

    protected $fillable = ['id_employee', 'id_menus', 'id_items', 'state'];
}
