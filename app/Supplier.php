<?php
/**
 * Created by PhpStorm.
 * User: adyopo
 * Date: 3/10/2018
 * Time: 11:54 AM
 */

namespace App;


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