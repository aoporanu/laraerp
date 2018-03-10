<?php
/**
 * Created by PhpStorm.
 * User: adyopo
 * Date: 3/10/2018
 * Time: 11:54 AM
 */

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

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}