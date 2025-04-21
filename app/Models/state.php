<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    protected $fillable = ['s_name'];

    public function employees()
    {
        return $this->hasMany(Employee::class, 'state_id');
    }
}