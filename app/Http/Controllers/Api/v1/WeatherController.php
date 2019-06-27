<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WeatherController extends Controller
{
    /**
     * ключь от яндекс API
     */
    const KEY_API = '3337092d-2c6d-4694-9758-3a32ff244784';
    /**
     * координаты Брянска
     */
    const COORDINATES = [
        'lat' => '53.2799469',
        'lon' => '34.2068798'
    ];

    /**
     * Вывести погоду брянска
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $opts = [
            "http" => [
                "method" => "GET",
                "header" => "X-Yandex-API-Key: " . self::KEY_API
            ]
        ];
        $context = stream_context_create($opts);

        $weather = @file_get_contents('https://api.weather.yandex.ru/v1/forecast?lat=' . self::COORDINATES['lat'] .
            '&lon=' . self::COORDINATES['lon'] .
            '&extra=true',
            false,
            $context);

        if ($weather) {
            $temp = json_decode($weather)->fact->temp;
            $sign = $temp > 0 ? '+' : '';
            $result = response($sign . $temp, 200);
        } else {
            $result = response('Error conect Yandex Weather', 200);
        }

        return $result;
    }
}
