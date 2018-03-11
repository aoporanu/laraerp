<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'sku',
        'order_id',
        'client_id',
        'created',
        'due',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function receipt()
    {
        return $this->hasMany(Receipt::class);
    }
}
