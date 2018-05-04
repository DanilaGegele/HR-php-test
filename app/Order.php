<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function partner()
    {
    	return $this->belongsTo('App\Partner');
    }

    public function products()
    {
    	return $this->belongsToMany('App\Product', 'order_products')->withPivot('quantity', 'price');
    }
    public function sumAmount()
    {
    	$products=$this->products;
    	$sum=0;
    	foreach($products as $product)
	    {
	    	$sum+=$product->price*$product->pivot->quantity;
	    }
	    return $sum;
    }
}
