<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Licence extends Model
{
    use HasFactory;

    protected $fillable = ['id_user', 'id_menus', 'id_items', 'state'];

    public function users()
    {
        return $this->belongsTo(users_app::class, 'id_user');
    }
}
