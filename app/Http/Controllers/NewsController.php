<?php

namespace App\Http\Controllers;

use App\Http\ApiClasses\NewsAPI;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NewsController extends Controller
{
    /**
     * @return View
     * @throws GuzzleException
     */
    public function index(): View
    {
        $newsApi = new NewsAPI();
        $news = $newsApi->getNews(null,null,null,null);

        $languagesArray = $newsApi->languagesArray();
        $countriesArray = $newsApi->countriesArray();
        $allNews = array();

        $allNews = $this->getNewsArray($news, $allNews);

        return view('projects.news', compact('allNews','languagesArray', 'countriesArray'));
    }


    public function submitForm(Request $request) : array
    {
        $newsApi = new NewsAPI();

        $language = $request->input('language');
        $subject = $request->input('subject');
        $country = $request->input('country');
        $category = $request->input('category');

        $news = $newsApi->getNews($subject, $language, $country, $category);

        $allNews = [];
        return $this->getNewsArray($news, $allNews);
    }

    /**
     * @param array $news
     * @param array $allNews
     * @return array
     */
    public function getNewsArray(array $news, array $allNews): array
    {
        if (isset($news['results'])) {
            foreach ($news['results'] as $new) {
                //first where image_url not null
                if($new['image_url'] != null) {
                    array_unshift($allNews, [
                        'title' => $new['title'],
                        'link' => $new['link'],
                        'creator' => $new['creator'],
                        'description' => $new['description'],
                        'content' => $new['content'],
                        'pubDate' => $new['pubDate'],
                        'image_url' => $new['image_url'],
                        'country' => $new['country'],
                    ]);
                } else {
                    $allNews[] = [
                        'title' => $new['title'],
                        'link' => $new['link'],
                        'creator' => $new['creator'],
                        'description' => $new['description'],
                        'content' => $new['content'],
                        'pubDate' => $new['pubDate'],
                        'image_url' => $new['image_url'],
                        'country' => $new['country'],
                    ];
                }
            }
        }
        return $allNews;
    }

}
