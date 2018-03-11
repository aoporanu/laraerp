<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    protected $fillable = [
        'sku',
        'user_id',
        'order_id',
    ];
}
