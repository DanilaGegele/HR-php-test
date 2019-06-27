<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WeatherController extends Controller
{
    /**
     * Вывести пгоду брянска
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $opts = [
            "http" => [
                "method" => "GET",
                "header" => "X-Yandex-API-Key: 3337092d-2c6d-4694-9758-3a32ff244784"
            ]
        ];
        $context = stream_context_create($opts);

        $weather = @file_get_contents('https://api.weather.yandex.ru/v1/forecast?lat=53.2799469&lon=34.2068798&extra=true',
            false,
            $context);

        if ($weather) {
            $result = response(json_decode($weather)->fact->temp, 200);
        } else {
            $result = response('Error conect Yandex Weather', 200);
        }

        return $result;
    }
}
