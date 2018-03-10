<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    protected $fillable = [
        'sku',
        'name'
    ];

    public function clients()
    {
        return $this->hasMany(Client::class);
    }
}
