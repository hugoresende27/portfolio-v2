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
     * /**
     * @OA\Get(
     *     path="/api/get-news",
     *     summary="Get news articles",
     *     tags={"News"},
     *     @OA\Parameter(
     *         name="query",
     *         in="query",
     *         description="Search query for news articles",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *             example="php OR laravel OR chatGPT OR frameworks OR tecnologia"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="language",
     *         in="query",
     *         description="Language of news articles",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *             example="pt"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(
     *                     property="title",
     *                     type="string",
     *                     example="Sample news article"
     *                 ),
     *                 @OA\Property(
     *                     property="link",
     *                     type="string",
     *                     example="https://example.com/news/sample-article"
     *                 ),
     *                 @OA\Property(
     *                     property="creator",
     *                     type="string",
     *                     example="John Doe"
     *                 ),
     *                 @OA\Property(
     *                     property="description",
     *                     type="string",
     *                     example="This is a sample news article"
     *                 ),
     *                 @OA\Property(
     *                     property="content",
     *                     type="string",
     *                     example="Lorem ipsum dolor sit amet, consectetur adipiscing elit."
     *                 ),
     *                 @OA\Property(
     *                     property="pubDate",
     *                     type="string",
     *                     example="2022-01-01 12:00:00"
     *                 ),
     *                 @OA\Property(
     *                     property="image_url",
     *                     type="string",
     *                     example="https://example.com/news/sample-article/image.jpg"
     *                 ),
     *                 @OA\Property(
     *                     property="country",
     *                     type="string",
     *                     example="US"
     *                 ),
     *             )
     *         )
     *     ),
         *    @OA\Response(
         *     response=500,
         *     description="Internal server error",
         *     @OA\JsonContent(
         *         @OA\Property(
         *             property="error",
         *             type="string",
         *             example="Failed to retrieve news. Please try again later."
         *         ),
         *         @OA\Property(
         *             property="log",
         *             type="string",
         *             example="Error message details"
         *         )
         *     )
         * )
     * )
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
            return [
                'error' => 'Failed to retrieve news. Please try again later.',
                'log' => $e->getMessage(),
                'code' => $e->getCode(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ];
        }
    }
}
