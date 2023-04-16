<?php

namespace App\Http\ApiClasses;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
class WeatherAPI
{

    private string $weatherApiToken ;
    private $client;


    public function __construct()
    {
        $this->weatherApiToken = env('WEATHER_API_TOKEN');
        $this->client = new Client();
    }


    public function getWeather(string $city = "Aveiro"): array
    {
        $request = $this->client->request('GET', 'http://api.weatherapi.com/v1/current.json?key='.$this->weatherApiToken.'&q='.$city.'&aqi=no');
        return json_decode($request->getBody()->getContents(), true);
    }
}
