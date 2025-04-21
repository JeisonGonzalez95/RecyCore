<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class menuItems extends Model
{
    use HasFactory;

    protected $table = 'menu_items';

    protected $fillable = ['name_item', 'route_item', 'main_menu_id', 'state'];

    public function mainMenu()
    {
        return $this->belongsTo(mainMenus::class, 'main_menu_id');
    }
}
