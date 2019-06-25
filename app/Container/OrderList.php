<?php

namespace App\Container;

use Illuminate\Support\Facades\DB;

class OrderList extends OrderContainer
{


    /**
     *   Вывести данные о заказах, решил соединить через join
     *      т.к. стандартные связь делает много запросов к базе данных
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function getOrderList()
    {
        return DB::table($this->order->getTable())
            ->join($this->partner->getTable(),
                $this->order->getTable() . '.partner_id', '=', $this->partner->getTable() . '.id')// добавляем таблицу партнёры
            ->join($this->orderProduct->getTable(),
                $this->orderProduct->getTable() . '.order_id', '=', $this->order->getTable() . '.id')// добавляем таблицу содержание заказа
            ->join($this->product->getTable(),
                $this->orderProduct->getTable() . '.product_id', '=', $this->product->getTable() . '.id')// добавляем таблицу продукты
            ->groupBy($this->order->getTable() . '.id')
            ->select([
                $this->order->getTable() . '.id',
                $this->partner->getTable() . '.name as name_partner',
                DB::raw('sum(' . $this->orderProduct->getTable() . '.price) * sum(' . $this->orderProduct->getTable() . '.quantity) as `sum`'),
                DB::raw('GROUP_CONCAT(' . $this->product->getTable() . '.name SEPARATOR ", ") as `products`'),
                $this->order->getTable() . '.status',
                $this->order->getTable() . '.delivery_dt',
            ]);
    }

    /**
     * Найти соответствующий заказ по его id
     *
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Model|null|static
     */
    public function findOrderList(int $id)
    {
        return $this->getOrderList()
            ->where($this->order->getTable() . '.id', '=', $id)
            ->first();
    }


    /**
     * Обновить данные заказа
     *
     * @param int $id
     * @param array $params
     * @return int
     */
    public function updateOrder(int $id, array $params)
    {
        return $this->order
            ->where($this->order->getTable() . '.id', '=', $id)
            ->update($params);
    }
}