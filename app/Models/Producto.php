<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'unidad_id',
        'nombre',
        'descripcion',
    ];

    public function usuario()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function unidadd()
    {
        return $this->hasOne(Unidad::class, 'id', 'unidad_id')->withDefault();
    }

    public function registros()
    {
        return $this->hasMany(Registro::class, 'producto_id', 'id');
    }
}
