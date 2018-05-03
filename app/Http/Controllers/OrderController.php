<?php

namespace App\Http\Controllers;

use App\Mail\OrderCompleted;
use Illuminate\Http\Request;
use Mail;
use App\Order;
use App\Partner;
use App\Http\Requests\StoreOrder;

define('STATE_NEW',0);
define('STATE_CONFIRMED',10);
define('STATE_COMPLETED',20);

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
		$states=[STATE_NEW=>'Новый', STATE_CONFIRMED=>'Подтвержден', STATE_COMPLETED=>'Завершен'];
    	return view('order_edit', ['order'=>$order, 'partners'=>$partners, 'states'=>$states]);
    }
    public function store(StoreOrder $request)
    {
	    $order=Order::find($request->get('id'));
	    $order->client_email=$request->get('client_email');
	    $order->partner_id=$request->get('partner_id');
	    $oldState=$order->status;
	    $order->status=$request->get('status');
	    if($order->save())
	    {
		    if ($oldState!==$order->status && $order->status==STATE_COMPLETED)
		    {
				Mail::to($order->partner->email)->send(new OrderCompleted($order));
				foreach ($order->products as $product)
				{
					Mail::to($product->vendor->email)->send(new OrderCompleted($order));
				}
		    }
	    	return redirect()->action('OrderController@index');
	    }
	    return redirect()->back()->withErrors('Ошибка сохранения');
    }

}
