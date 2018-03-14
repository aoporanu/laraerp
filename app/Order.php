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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function receipt()
    {
        return $this->belongsTo(Receipt::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne|mixed
     */
    public function Invoice()
    {
        return $this->hasOne(Invoice::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
