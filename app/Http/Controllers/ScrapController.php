<?php

namespace App\Http\Controllers;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\DomCrawler\Crawler;


class ScrapController extends Controller
{

    /**
     * @return View
     */
    public function index(): View
    {
        return view('projects.scraper');
    }


    public function scraperWebForm(Request $request)
    {
        $this->scraper($request);
    }
    /**
     * @OA\Post(
     *     path="/api/scraper",
     *     summary="Scrape HTML content from a URL",
     *     tags={"Scraper"},
     *     @OA\RequestBody(
     *         required=true,
     *         description="URL to scrape",
     *         @OA\JsonContent(
     *             @OA\Property(property="url", type="string", example="https://www.hcpro.pt")
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Scraped content",
     *         @OA\JsonContent(
     *             @OA\Property(property="title", type="string", example="Example Domain"),
     *             @OA\Property(property="class_names", type="array",
     *                 @OA\Items(type="string", example="example-class")
     *             ),
     *             @OA\Property(property="links", type="array",
     *                 @OA\Items(type="string", example="https://www.iana.org/domains/example")
     *             ),
     *             @OA\Property(property="html", type="string", example="<html>...</html>"),
     *             @OA\Property(property="all", type="object", example="Crawler object")
     *         )
     *     )
     * )
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function scraper(Request $request): JsonResponse
    {

        try {
            $url = $this->normalizeUrl($request->url);
            $html = $this->getContentsHtml($url);
            $crawler = new Crawler($html);
            $title = $this->getTitle($crawler);
            $links = $this->getLinks($crawler);
            $linksFinal = $this->categorizeLinks($links);
            $divAttr = $this->getAttributesDiv($crawler);
        }catch (\Exception){

        }



        return response()->json([
            'title' => $title ?? null,
            'links' => $linksFinal ?? null,
            'div_attributes' => $divAttr ?? null,
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
    private function getAttributesDiv(Crawler $crawler): array
    {
        // Get all div elements
        $divElements = $crawler->filter('div');

        // Initialize an array to store the class names
        $classNames = array();
        $idsNames = array();
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

            $idAttr = $div->getAttribute('id');

            if ($idAttr) {
                // Split the class attribute value by whitespace to get the class names
                $idsArray = explode(' ', $idAttr);

                // Loop through each class name
                foreach ($idsArray as $idsName) {
                    // Add the class name to the array if it doesn't already exist
                    if (!in_array($idsName, $idsNames)) {
                        $idsNames[] = $idsName;
                    }
                }
            }
        }

        $attrs = array();
        foreach ($divElements as $attr) {
            $name = $attr->nodeName;
            $value = $attr->nodeValue;
            $value = preg_replace('/\s+/', ' ', $value);
            $value = trim($value);
            if (empty($value)){
                $value = false;
            }
            if ($value) {
                $attrs[] = [
                    'name' => $name,
                    'value' => $value
                ];
            }


        }
        return [
            'attributes' => $attrs,
            'class_names'=>$classNames,
            'ids_names'=> $idsNames,

        ];
    }


    /**
     * @param $url
     * @return string
     */
    private function normalizeUrl($url) :string
    {
        // Add "https://" if the URL doesn't start with "http://" or "https://"
        if (!preg_match('~^(?:f|ht)tps?://~i', $url)) {
            $url = "https://" . $url;
        }

        // Remove any trailing slashes
        $url = rtrim($url, "/");

        // Remove a trailing slash if present
        if (str_ends_with($url, '/')) {
            $url = substr($url, 0, -1);
        }

        return $url;
    }

    /**
     * @param array $links
     * @return array[]
     */
    private function categorizeLinks(array $links): array
    {
        $httpLinks = [];
        $nonHttpLinks = [];

        foreach ($links as $link) {
            // Ignore links that start with #
            if ($link=== "#" || $link =="/") {
                continue;
            }

            // Categorize links based on whether they start with http:// or https://
            if (str_contains($link, 'http://') || str_contains($link, 'https://')) {
                $httpLinks[] = $link;
            } else {
                $nonHttpLinks[] = $link;
            }
        }

        return [
            'page_links' => $nonHttpLinks,
            'external_links' => $httpLinks,
        ];
    }






}
