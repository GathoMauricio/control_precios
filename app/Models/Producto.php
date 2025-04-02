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
        'nombre',
        'descripcion',
        'unidad',
    ];

    public function usuario()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
