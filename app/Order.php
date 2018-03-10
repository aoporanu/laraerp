<?php

namespace App;

use Amsgames\LaravelShop\Models\ShopOrderModel;

class Order extends ShopOrderModel
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
