<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alimentos extends Model
{
    
    public $timestamps = false;

    protected $fillable = [
        'desayuno',
        'comida',
        'cena',
        'extra'
    ];

    
}
