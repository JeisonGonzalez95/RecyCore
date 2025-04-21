<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mainMenus extends Model
{
    use HasFactory;

    protected $table = 'main_menus'; // Nombre correcto de la tabla

    protected $fillable = ['name_menu', 'slug_menu', 'state'];

    public function items()
    {
        return $this->hasMany(menuItems::class, 'main_menu_id'); // se especifica el campo correcto
    }
}
