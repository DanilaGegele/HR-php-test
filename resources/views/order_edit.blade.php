@extends('main')
@section('content')
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form class="form-horizontal" action="/order/{{$order->id}}/update" method="post">
        <fieldset>

            <!-- Form Name -->
            <legend>Редактирование заказа №{{$order->id}}</legend>
            <input id="id" name="id" type="hidden" value="{{$order->id}}">
            <!-- Text input-->

            <div class="form-group">
                <label class="col-md-4 control-label" for="email">E-mail</label>
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-addon">@</span>
                    <input id="email" name="client_email" type="email" value="{{$order->client_email}}" class="form-control input-md" required="">
                </div>
                </div>
            </div>

            <!-- Select Basic -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="partner">Партнер</label>
                <div class="col-md-4">
                    <select id="partner" name="partner_id" class="form-control" required="">
                        @foreach($partners as $partner)
                        <option value="{{$partner->id}}"
                        @if($order->partner->id==$partner->id)
                            selected
                        @endif
                        >{{$partner->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">Стоимость</label>
                <div class="col-md-4">
                    <div class="panel">
                        <div class="panel-body">
                            {{$order->sumAmount()}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">Состав заказа</label>
                <div class="col-md-4">
                    <div class="panel">
                        <div class="panel-body">
                        @foreach($order->products as $product)
                            {{$product->name.' - '.$product->pivot->quantity.' шт.'}}<br>
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Select Basic -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="state">Статус</label>
                <div class="col-md-4">
                    <select id="state" name="status" class="form-control" required="">
                        @foreach($states as $key => $state)
                        <option value="{{$key}}"
                        @if($order->status==$key)
                            selected
                        @endif
                            >{{$state}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Button -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="save"></label>
                <div class="col-md-4">
                    <button id="save" name="save" class="btn btn-primary">Сохранить</button>
                </div>
            </div>
            {{csrf_field()}}
        </fieldset>
    </form>
@endsection