<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
    	$products=Product::orderBy('name')->paginate(25);
    	return view('products', ['products'=>$products]);
    }
    public function priceEdit(Request $request)
    {
    	$productID=$request['productID'];
    	$newPrice=$request['newPrice'];
    	if($productID!=0 && $newPrice!=0)
	    {
		    $product = Product::find($productID);
		    $product->price = $newPrice == 0 ? $product->price : $newPrice;
		    if ($product->save())
		    {
			    return json_encode(['status' => 'success'], JSON_UNESCAPED_UNICODE);
		    }
	    }
    }
}
