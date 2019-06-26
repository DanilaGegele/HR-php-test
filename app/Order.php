<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * @var int статус подтвержден
     */
    const STATUS_CONFIRMED = 10;
    /**
     * @var int статус новый
     */
    const STATUS_NEW = 0;
    /**
     * @var int статус завершен
     */
    const STATUS_COMPLETED = 20;

    protected $table="orders";

    /**
     * Связт с партнёром
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }

    /**
     * Связь к продуктам в заказе
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderProduct()
    {
        return $this->hasMany(OrderProduct::class);
    }

    /**
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function product()
    {
        return $this->belongsToMany(Product::class, 'order_products')
            ->withPivot('quantity','price');
    }





}
