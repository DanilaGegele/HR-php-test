<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Libs\WorldWeatherOnline;

class WeatherController extends Controller
{
    public function index(){
        $weather=new WorldWeatherOnline('json');
        $weather->setLocation('Брянск');
        $error='';
        $curruntWeather=array();
        if ($weather->getData())
        {
        	$data=json_decode($weather->getData());
	        if(property_exists($data->data, 'error'))
	        {
	        	$error=$data->data->error[0]->msg;
	        }
	        if(property_exists($data->data, 'current_condition'))
	        {
	        	$curruntWeather=$this->prepareWeather($data->data->current_condition[0]);
	        }
        }

        return view('weather',['error'=>$error, 'currentWeather'=>$curruntWeather]);
    }

    protected function prepareWeather($object)
    {
    	$weather=array();
    	$weather['temp']=$object->temp_C;
    	$weather['icon']=$object->weatherIconUrl[0]->value;
    	$weather['desc']=$object->lang_ru[0]->value;
    	return $weather;
    }
}
