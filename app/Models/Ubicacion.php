<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table = 'ubicacions';

    protected $fillable = [
        'name',
    ];
}
