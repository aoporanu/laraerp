<?php
/**
 * Created by PhpStorm.
 * User: adyopo
 * Date: 3/12/2018
 * Time: 10:15 AM
 */

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