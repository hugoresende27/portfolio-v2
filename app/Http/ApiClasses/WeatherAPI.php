<?php

namespace App\Http\ApiClasses;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Component\HttpFoundation\Request;

class WeatherAPI
{

    private string $weatherApiToken ;
    private $client;


    public function __construct()
    {
        $this->weatherApiToken = env('WEATHER_API_TOKEN');
        $this->client = new Client();
    }


    /**
     * @param string $city
     * @return array
     * @throws GuzzleException
     */
    public function getWeather(string $city = "Aveiro"): array
    {
        $request = $this->client->request('GET', 'http://api.weatherapi.com/v1/current.json?key='.$this->weatherApiToken.'&q='.$city.'&aqi=no');
        return json_decode($request->getBody()->getContents(), true);
    }

    /**
     * @param Request $request
     * @return array
     * @throws GuzzleException
     */
    public function getWeatherLocations(Request $request): array
    {
        $city = $request->location;
        $req = $this->client->request('GET', 'http://api.weatherapi.com/v1/current.json?key='.$this->weatherApiToken.'&q='.$city.'&aqi=no');
        return json_decode($req->getBody()->getContents(), true);
    }
}
