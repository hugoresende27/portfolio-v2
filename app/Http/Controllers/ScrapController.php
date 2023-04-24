<?php

namespace App\Http\Controllers;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\DomCrawler\Crawler;


class ScrapController extends Controller
{

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function scraper(Request $request): JsonResponse
    {

        $url = $request->url;
        $html = $this->getContentsHtml($url);
        $crawler = new Crawler($html);
        $title = $this->getTitle($crawler);
        $links = $this->getLinks($crawler);
        $classNames = $this->getClassNames($crawler);


        return response()->json([
            'title' => $title ?? null,
            'class_names' => $classNames,
            'links' => $links ?? null,
            'html' => $html,
            'all' => $crawler,
        ]);


    }


    /**
     * @param string $url
     * @return string
     */
    private function getContentsHtml(string $url): string
    {
        $context = stream_context_create([
            'ssl' => [
                'crypto_method' => STREAM_CRYPTO_METHOD_TLSv1_2_CLIENT,
                'ciphers' => 'DEFAULT:!DH',
            ],
        ]);

        return file_get_contents($url, false, $context);
    }

    /**
     * @param Crawler $crawler
     * @return string
     */
    private function getTitle(Crawler $crawler): string
    {
        return  $crawler->filterXPath('//title')->text();
    }

    /**
     * @param Crawler $crawler
     * @return array
     */
    private function getLinks(Crawler $crawler): array
    {
        return $crawler->filterXPath('//a')->each(function (Crawler $node, $i) {
            return $node->attr('href');
        });
    }


    /**
     * @param Crawler $crawler
     * @return array
     */
    private function getClassNames(Crawler $crawler): array
    {
        // Get all div elements
        $divElements = $crawler->filter('div');

        // Initialize an array to store the class names
        $classNames = array();

        // Loop through each div element
        foreach ($divElements as $div) {
            // Get the class attribute value
            $classAttr = $div->getAttribute('class');

            // If the class attribute exists and is not empty
            if ($classAttr) {
                // Split the class attribute value by whitespace to get the class names
                $classNamesArray = explode(' ', $classAttr);

                // Loop through each class name
                foreach ($classNamesArray as $className) {
                    // Add the class name to the array if it doesn't already exist
                    if (!in_array($className, $classNames)) {
                        $classNames[] = $className;
                    }
                }
            }
        }
        return $classNames;
    }
}
