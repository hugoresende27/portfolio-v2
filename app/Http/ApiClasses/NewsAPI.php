<?php

namespace App\Http\ApiClasses;

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


    public function getNews(
        string $query = "php OR laravel OR chatGPT OR frameworks OR tecnologia",
        string $language = "pt"): array
    {

        $url = $this->apiUrl."/1/news?apikey=".$this->newsApiToken."&q=".$query."&language=".$language;
        $request = $this->client->request('GET', $url);
        return json_decode($request->getBody()->getContents(), true);
    }
}
