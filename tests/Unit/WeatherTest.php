<?php

namespace Tests\Unit;

use Tests\TestCase;

class WeatherTest extends TestCase
{
    /**
     * Проверить получение погода города Брянск
     *
     * @return void
     */
    public function testExample()
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

        $this->assertNotFalse($weather);

        if($weather){
            $res = json_decode($weather);
            $this->assertTrue(isset($res->fact->temp));
        }
    }
}
