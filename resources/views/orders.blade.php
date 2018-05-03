@extends('main')
@section('content')
    <div>

        <!-- Навигационные вкладки -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#all" aria-controls="all" role="tab" data-toggle="tab">Все</a></li>
            <li role="presentation"><a href="#expired" aria-controls="expired" role="tab" data-toggle="tab">Просроченные</a></li>
            <li role="presentation"><a href="#current" aria-controls="current" role="tab" data-toggle="tab">Текущие</a></li>
            <li role="presentation"><a href="#new" aria-controls="new" role="tab" data-toggle="tab">Новые</a></li>
            <li role="presentation"><a href="#completed" aria-controls="completed" role="tab" data-toggle="tab">Завершенные</a></li>
        </ul>

        <!-- Вкладки панелей -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="all">
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
                                @if ($order->status === STATE_CONFIRMED)
                                    {{'Подтвержден'}}
                                @elseif ($order->status === STATE_COMPLETED)
                                    {{'Завершен'}}
                                @else
                                    {{'Новый'}}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <div role="tabpanel" class="tab-pane active" id="expired">
                <table class="table">
                    <tr>
                        <th>ИД</th>
                        <th>Партнер</th>
                        <th>Сумма</th>
                        <th>Состав заказа</th>
                        <th>Статус</th>
                    </tr>
                    @foreach ($expired as $order)
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
                                @if ($order->status === STATE_CONFIRMED)
                                    {{'Подтвержден'}}
                                @elseif ($order->status === STATE_COMPLETED)
                                    {{'Завершен'}}
                                @else
                                    {{'Новый'}}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <div role="tabpanel" class="tab-pane active" id="current">
                <table class="table">
                    <tr>
                        <th>ИД</th>
                        <th>Партнер</th>
                        <th>Сумма</th>
                        <th>Состав заказа</th>
                        <th>Статус</th>
                    </tr>
                    @foreach ($current as $order)
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
                                @if ($order->status === STATE_CONFIRMED)
                                    {{'Подтвержден'}}
                                @elseif ($order->status === STATE_COMPLETED)
                                    {{'Завершен'}}
                                @else
                                    {{'Новый'}}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <div role="tabpanel" class="tab-pane" id="new">
                <table class="table">
                    <tr>
                        <th>ИД</th>
                        <th>Партнер</th>
                        <th>Сумма</th>
                        <th>Состав заказа</th>
                        <th>Статус</th>
                    </tr>
                    @foreach ($new as $order)
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
                                @if ($order->status === STATE_CONFIRMED)
                                    {{'Подтвержден'}}
                                @elseif ($order->status === STATE_COMPLETED)
                                    {{'Завершен'}}
                                @else
                                    {{'Новый'}}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <div role="tabpanel" class="tab-pane" id="completed">
                <table class="table">
                    <tr>
                        <th>ИД</th>
                        <th>Партнер</th>
                        <th>Сумма</th>
                        <th>Состав заказа</th>
                        <th>Статус</th>
                    </tr>
                    @foreach ($completed as $order)
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
                                @if ($order->status === STATE_CONFIRMED)
                                    {{'Подтвержден'}}
                                @elseif ($order->status === STATE_COMPLETED)
                                    {{'Завершен'}}
                                @else
                                    {{'Новый'}}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <div role="tabpanel" class="tab-pane" id="settings">...</div>
        </div>

    </div>

    @endsection