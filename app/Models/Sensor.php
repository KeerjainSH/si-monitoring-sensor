<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    use HasFactory;

    protected $table = 'sensor' ;

    protected $fillable = [
        'sensor1',
        'sensor2',
        'sensor3',
        'sensor4',
        'sensor5'
    ];
}
