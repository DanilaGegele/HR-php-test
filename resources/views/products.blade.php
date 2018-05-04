@extends('main')
@section('content')
    <div class="panel panel-default">

        <div class="panel-heading">Список продуктов</div>

        <!-- Таблица -->
        <table class="table">
            <tr>
                <th>ИД</th>
                <th>Наименование</th>
                <th>Поставщик</th>
                <th>Цена</th>
            </tr>
            @foreach($products as $product)
                <tr>
                    <td>{{$product->id}}</td>
                    <td>{{$product->name}}</td>
                    <td>{{$product->vendor->name}}</td>
                    <td class="col-md-4"><div class="price">
                        <span class="price-text">{{$product->price}}</span>
                        <div class="price-edit">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="text" class="form-control" data-id={{$product->id}} name="price" value="{{$product->price}}">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" id="price-change" type="button">
                                            <span>OK</span>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    {{$products->links()}}
@endsection