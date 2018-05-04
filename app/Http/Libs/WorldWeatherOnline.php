<?php
/**
 * Created by PhpStorm.
 * User: Aslangery
 * Date: 29.04.2018
 * Time: 7:57
 */
namespace App\Http\Libs;

class WorldWeatherOnline
{
	//ключ погодного сервиса
	protected $key='25916d89275345a397345515182904';

	//url для запросов
	protected $url='http://api.worldweatheronline.com/premium/v1/weather.ashx';

	//язык
	protected $lang='ru';

	//формат ответа: xml, json, csv, tab
	protected $format='json';

	protected $location='';

	protected $requestURL='';

	protected $numOfDays=1;

	public function __construct(string $format='json')
	{
		$this->format=$format;
	}

	/**
	 * @param string $location
	 */
	public function setLocation(string $location)
	{
		$this->location = $location;
	}

	protected function createRequestURL()
	{
		$url=$this->url;
		$url.='?key='.$this->key;
		$url.='&format='.$this->format;
		$url.='&lang='.$this->lang;
		$url.='&num_of_days='.$this->numOfDays;
		$url.='&q='.urlencode($this->location);

		return $url;
	}

	public function getData()
	{
		if ($curl = curl_init ())
		{
			$url=$this->createRequestURL();
			curl_setopt ($curl, CURLOPT_URL, $url);
			curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt ($curl, CURLOPT_HEADER, 0);
			$result = curl_exec ($curl);
			curl_close ($curl);
			return $result;
		}

		return false;
	}
}