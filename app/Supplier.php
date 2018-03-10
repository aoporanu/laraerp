<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    /**
     * @return mixed
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}