<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    use HasFactory;

    protected $table = 'registros';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'producto_id',
        'estatus',
    ];

    public function usuario()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function producto()
    {
        return $this->hasOne(Producto::class, 'id', 'producto_id');
    }

    public function cotizaciones()
    {
        return $this->hasMany(Cotizacion::class, 'registro_id', 'id');
    }
}
