<?php

namespace Tests\Unit;

use App\Http\Controllers\Api\v1\WeatherController;
use Tests\TestCase;

class WeatherTest extends TestCase
{
    /**
     * Проверить получение погоды города Брянск
     *
     * @return void
     */
    public function testExample()
    {
        $opts = [
            "http" => [
                "method" => "GET",
                "header" => "X-Yandex-API-Key: ". WeatherController::KEY_API
            ]
        ];
        $context = stream_context_create($opts);

        $weather = @file_get_contents('https://api.weather.yandex.ru/v1/forecast?lat='.WeatherController::COORDINATES['lat'].
            '&lon='.WeatherController::COORDINATES['lon'].'&extra=true',
            false,
            $context);

        $this->assertNotFalse($weather);

        if($weather){
            $res = json_decode($weather);
            $this->assertTrue(isset($res->fact->temp));
        }
    }
}
