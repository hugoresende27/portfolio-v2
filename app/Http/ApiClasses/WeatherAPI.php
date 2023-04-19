<?php

namespace App\Http\ApiClasses;

use DateTime;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Component\HttpFoundation\Request;

class WeatherAPI
{

    private string $weatherApiToken ;
    private Client $client;


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
        $time = "current";
        $url = "http://api.weatherapi.com/v1/".$time.".json?key=".$this->weatherApiToken."&q=".$city.'&aqi=no';
        $request = $this->client->request('GET', $url);
        return json_decode($request->getBody()->getContents(), true);
    }

    /**
     * @param Request $request
     * @param string $city
     * @return array
     * @throws GuzzleException
     */
    public function getWeatherFuture(Request $request , string $city = "Aveiro"): array
    {
        $tomorrow = $this->getFuture();
        $time = "future";
        if (isset($request->city)) {
            $city = $request->city;
        }

        $url = "http://api.weatherapi.com/v1/".$time.".json?key=".$this->weatherApiToken."&q=".$city."&dt=".$tomorrow;
        $request = $this->client->request('GET', $url);
        return json_decode($request->getBody()->getContents(), true);
    }

    /**
     * @param Request $request
     * @return array
     * @throws GuzzleException
     */
    public function getWeatherLocations(Request $request): array
    {
        $city = $request->location ?? "Aveiro";
        $req = $this->client->request('GET', 'http://api.weatherapi.com/v1/current.json?key='.$this->weatherApiToken.'&q='.$city.'&aqi=no');
        return json_decode($req->getBody()->getContents(), true);
    }


    /**
     * @return string
     */
    private function getFuture(): string
    {
        $today = new DateTime();
        $tomorrow = $today->modify('+14 day');
        return $tomorrow->format('Y-m-d');
    }
}
