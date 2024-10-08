<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMoodle extends Model
{
    use HasFactory;

    protected $connection = 'second_db';

    protected $table = 'mdl_user';
}
