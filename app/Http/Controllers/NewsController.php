<?php

namespace App\Http\Controllers;

use App\Http\ApiClasses\NewsAPI;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NewsController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $newsApi = new NewsAPI();
        $news = $newsApi->getNews("tech","en");
        $allNews = array();

        dd($news);
        foreach ($news['results'] as $new) {

            $allNews[]=[
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

        return view('projects.news', compact('allNews'));
    }
}
