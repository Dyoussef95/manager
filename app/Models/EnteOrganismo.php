<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnteOrganismo extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table = 'enteorganismo';

    protected $fillable = [
        'name',
    ];
}
