<?php

namespace App\Container;


class OrderList extends OrderContainer
{


    /**
     *  Вывожу заказы со всеми зависимости
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function getOrderList()
    {
        return $this->order::with([
            'partner',
            'product'
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