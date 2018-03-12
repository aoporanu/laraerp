<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SType extends Model
{
    protected $fillable = [
        'name',
        'qty',
        'weight',
        'price',
        'lot',
        'for'
    ];
}