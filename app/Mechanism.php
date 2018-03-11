<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mechanism extends Model
{
    protected $fillable = [
        'qty',
        'product_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function promotion()
    {
        return $this->belongsTo(Promotion::class);
    }
}
