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
}
