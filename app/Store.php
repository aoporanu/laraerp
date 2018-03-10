<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $fillable = [
        'id',
        'sku',
        'name',
        'address',
    ];

    public function clients()
    {
        return $this->hasMany(Client::class);
    }
}
