<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Partner;
use App\Http\Requests\StoreOrder;

class OrderController extends Controller
{
    public function index()
    {
    	$orders=Order::all();
	    return view('orders', ['orders'=>$orders, ]);
    }
    public function edit($id)
    {
    	$order=Order::find($id);
    	$partners=Partner::all();
		$states=['0'=>'Новый', '10'=>'Подтвержден', '20'=>'Завершен'];
    	return view('order_edit', ['order'=>$order, 'partners'=>$partners, 'states'=>$states]);
    }
    public function store(StoreOrder $request)
    {
	    $order=Order::find($request->get('id'));
	    $order->client_email=$request->get('client_email');
	    $order->partner_id=$request->get('partner_id');
	    $order->status=$request->get('status');
	    if($order->save())
	    {
		    return redirect()->action('OrderController@index');
	    }
	    return redirect()->back()->withErrors('Ошибка сохранения');
    }

}
