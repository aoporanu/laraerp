<?php

namespace App;

use Amsgames\LaravelShop\Traits\ShopItemTrait;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use ShopItemTrait;

    protected $itemName = 'product_name';

    protected $itemRouteName = 'product';

    protected $itemRouteParams = ['slug'];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
