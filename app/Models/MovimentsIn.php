<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property \App\Models\Client|\App\Models\Collector|null $client_data
 */
class MovimentsIn extends Model
{
    use HasFactory;

    protected $table = 'moviments_in';

    protected $fillable = ['type_client', 'id_client', 'employee_id', 'date_in', 'description'];
    protected $casts = [
        'date_in' => 'datetime',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function products()
    {
        return $this->hasMany(ProductMoviment::class, 'id_moviment_in');
    }

    /**
     * Accesor para obtener el cliente o recolector asociado dinámicamente.
     *
     * @return \App\Models\Client|\App\Models\Collector|null
     */
    public function getClientDataAttribute()
    {
        return match ($this->type_client) {
            1 => \App\Models\Collector::find($this->id_client),
            2 => \App\Models\Client::find($this->id_client),
            default => null,
        };
    }
}
