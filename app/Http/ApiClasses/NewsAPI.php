<?php

namespace App\Http\ApiClasses;

use Exception;
use GuzzleHttp\Exception\GuzzleException;

class NewsAPI extends ClientAPI
{
    private string $newsApiToken ;
    private string $apiUrl;

    public function __construct()
    {
        $this->newsApiToken = env('NEWS_API_TOKEN');
        $this->apiUrl = "https://newsdata.io/api";
        parent::__construct();
    }


    /**
     * @param string $query
     * @param string $language
     * @return array
     * @throws GuzzleException
     */
    public function getNews(
        string $query = "php OR laravel OR chatGPT OR frameworks OR tecnologia",
        string $language = "pt"): array
    {
        $url = $this->apiUrl . "/1/news?apikey=" . $this->newsApiToken . "&q=" . $query . "&language=" . $language;

        try {
            $request = $this->client->request('GET', $url);
            return json_decode($request->getBody()->getContents(), true);
        } catch (Exception $e) {
            // Log the error message for debugging
             error_log($e->getMessage());

            // Return a custom error message to the user
            return ['error' => 'Failed to retrieve news. Please try again later.', 'log' => $e->getMessage()];
        }
    }
}
