@extends('main')
@section('content')
<div class="panel panel-default">

    <div class="panel-heading"><h3>Заказы</h3></div>

    <table class="table">
        <tr>
            <th>ИД</th>
            <th>Партнер</th>
            <th>Сумма</th>
            <th>Состав заказа</th>
            <th>Статус</th>
        </tr>
        @foreach ($orders as $order)
            <tr>
                <td><a href="/order/{{$order->id}}/edit">{{$order->id}}</a></td>
                <td>{{$order->partner->name}}</td>
                <td>{{$order->sumAmount()}}</td>
                <td>
                    @foreach($order->products as $product)
                        {{$product->name.' - '.$product->pivot->quantity.' шт.'}}<br>
                    @endforeach
                </td>
                <td>
                    @if ($order->status === 10)
                        {{'Подтвержден'}}
                    @elseif ($order->status === 20)
                        {{'Завершен'}}
                    @else
                        {{'Новый'}}
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
</div>
    @endsection