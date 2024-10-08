<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DependenciaDepartamento extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table = 'dependencia_departamentos';

    protected $fillable = [
        'name',
    ];
}
