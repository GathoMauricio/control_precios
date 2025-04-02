<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDotech extends Model
{
    use HasFactory;

    protected $connection = 'dotech';
    protected $table = 'users';
    protected $primaryKey = 'id';
}
