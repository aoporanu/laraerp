<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'sku',
        'name'
    ];

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
