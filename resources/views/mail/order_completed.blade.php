<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script type="text/javascript" src="{{url('/js/app.js')}}"></script>
    <link href="{{url('/css/app.css')}}" rel="stylesheet"/>


</head>
<body>
<div class="panel panel-default">

    <div class="panel-heading">Заказ №{{$order->id}} завершен.</div>
    <div class="panel-body">
        <p>Состав заказа:</p>
    </div>

    <!-- Таблица -->
    <table class="table">
        <tr>
            <th>Наименование</th>
            <th>Количество</th>
        </tr>
        @foreach($order->products as $product)
            <tr>
                <td>{{$product->name}}</td>
                <td>{{$product->pivot->quantity}}</td>
            </tr>
        @endforeach
    </table>
    <div class="panel-footer">Стоимость заказа: {{$order->sumAmount()}}</div>
</div>

</body>
</html>