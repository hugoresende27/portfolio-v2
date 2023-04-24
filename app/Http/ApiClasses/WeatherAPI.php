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
     * @OA\Get(
     *     path="/api/get-weather",
     *     summary="Get the current weather for a given city",
     *     tags={"Weather"},
     *     @OA\Parameter(
     *         name="city",
     *         in="query",
     *         description="The name of the city for which to retrieve the weather",
     *         required=false,
     *         example="Aveiro"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 description="Weather information",
     *                 @OA\Property(property="location", type="object",
     *                     @OA\Property(property="name", type="string", description="The name of the location"),
     *                     @OA\Property(property="region", type="string", description="The region of the location"),
     *                     @OA\Property(property="country", type="string", description="The country of the location"),
     *                     @OA\Property(property="lat", type="number", description="The latitude of the location"),
     *                     @OA\Property(property="lon", type="number", description="The longitude of the location"),
     *                     @OA\Property(property="tz_id", type="string", description="The timezone ID of the location"),
     *                     @OA\Property(property="localtime", type="string", description="The local time of the location in the format 'YYYY-MM-DD HH:mm'"),
     *                     @OA\Property(property="utc_offset", type="string", description="The UTC offset of the location in the format '+HH:mm'"),
     *                 ),
     *                 @OA\Property(property="current", type="object",
     *                     @OA\Property(property="temp_c", type="number", description="The temperature in Celsius"),
     *                     @OA\Property(property="temp_f", type="number", description="The temperature in Fahrenheit"),
     *                     @OA\Property(property="condition", type="object",
     *                         @OA\Property(property="text", type="string", description="The weather condition"),
     *                         @OA\Property(property="icon", type="string", description="The URL of the weather icon"),
     *                     ),
     *                 ),
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid city parameter",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", description="Error message"),
     *         ),
     *     ),
     * )
     */
    public function getWeather(string $city = "Aveiro"): array
    {
        $time = "current";
        $url = "http://api.weatherapi.com/v1/".$time.".json?key=".$this->weatherApiToken."&q=".$city.'&aqi=no';
        $request = $this->client->request('GET', $url);
        return json_decode($request->getBody()->getContents(), true);
    }

    /**
     * Retrieve future weather forecast for a specific city.
     *
     * @OA\POST(
     *     path="/api/get-weather-future",
     *     summary="Retrieve future weather forecast for a specific city.",
     *     tags={"Weather"},
     *     @OA\Parameter(
     *         name="city",
     *         in="query",
     *         description="City name to retrieve the forecast for. Defaults to Aveiro if not specified.",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *             example="London"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Returns the future weather forecast for the specified city.",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *             )
     *         )
     *     )
     * )
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
