<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $table = 'order_products';

    public function product()
    {
        return $this->hasMany(Product::class);
    }

}
