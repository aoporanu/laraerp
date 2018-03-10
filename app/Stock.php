<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = [
        'sku',
        'name'
    ];

    public function supplier()
    {
        return $this->hasMany(Supplier::class);
    }
}
