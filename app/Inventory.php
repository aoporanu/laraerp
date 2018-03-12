<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Inventory
 *
 * Holds products of various types, paid and free at the moment.
 * The stock should not exceed the maximum quantity of the product->qty field
 *
 * @package App
 */
class Inventory extends Model
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
