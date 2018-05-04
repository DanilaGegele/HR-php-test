<?php

namespace App\Http\Controllers;

use App\Mail\OrderCompleted;
use Carbon\Carbon;
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
    	$expired=$orders->where('status',STATE_CONFIRMED)
		    ->filter(function($item){$date=Carbon::now()->format('Y-m-d H:i:s'); return $item->delivery_dt < $date;})
		    ->sortByDesc('delivery_dt')
		    ->take(50);

		$current=$orders->where('status', STATE_CONFIRMED)
			->filter(function($item){$date_to = Carbon::now()->addDay()->format('Y-m-d H:i:s'); return $item->delivery_dt<$date_to;})
			->filter(function($item){$date_from = Carbon::now()->format('Y-m-d H:i:s'); return $item->delivery_dt>=$date_from;})
			->sortBy('delivery_dt');

    	$new=$orders->where('status',STATE_NEW)
		    ->filter(function($item){$date=Carbon::now()->format('Y-m-d H:i:s'); return $item->delivery_dt > $date;})
		    ->sortBy('delivery_dt')
	        ->take(50);


    	$completed=$orders->where('status',STATE_COMPLETED)
		        ->filter(function($item){$date_from = Carbon::today()->format('Y-m-d H:i:s');return $item->delivery_dt>=$date_from;})
		        ->filter(function($item){$date_to = Carbon::tomorrow()->subSecond()->format('Y-m-d H:i:s');return $item->delivery_dt<$date_to;})
				->sortByDesc('delivery_dt')
				->take(50);

	    return view('orders', ['orders'=>$orders, 'new'=>$new, 'completed'=>$completed, 'current'=>$current, 'expired'=>$expired,]);
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
