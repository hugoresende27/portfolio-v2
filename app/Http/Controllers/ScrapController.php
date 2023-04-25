<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use PHPUnit\Exception;
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
        $res = $this->scraper($request);
        $results = json_decode($res->getContent());


        return view('projects.scraper', [
            'responseMessage' => $results,
        ]);
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

        $url = $this->normalizeUrl($request->url);

        if ($url){
            try {

                $html = $this->getContentsHtml($url);
                $crawler = new Crawler($html);
                $title = $this->getTitle($crawler);

                $siteSpecs = $this->getSiteSpecs($url);

                $links = $this->getLinks($crawler);

                $linksFinal = $this->categorizeLinks($links,$url);

                $divAttr = $this->getAttributesDiv($crawler);

                $images = $this->getImages($crawler);
                $imagesFinal = $this->getImagesLinks($images,$url);
            } catch (\Exception $e) {
            }


        }


        return response()->json([
            'original_link' => $request->url ?? null,
            'domain' => $url ?? null,
            'title' => $title ?? null,
            'specs' => $siteSpecs ?? null,
            'images' => $imagesFinal ?? null,
            'links' => $linksFinal ?? null,
            'div_attributes' => $divAttr ?? null,
            'errors' => $e ?? null
        ]);

    }


    private function getSiteSpecs(string $url): array
    {
        $client = new Client(['curl' => [CURLOPT_SSL_CIPHER_LIST => 'DEFAULT@SECLEVEL=1']]);
        $response = $client->request('HEAD', $url);

        $headers = [
            'Date',
            'Content-Type',
            'Server',
            'X-Powered-By',
            'Connection',
            'Expires',
            'Content-language',
            'Last-Modified',
            'Set-Cookie',
            'X-Frame-Options',
        ];

        $specs = [];
        foreach ($headers as $header) {
            if ($response->hasHeader($header)) {
                $specs[$header] = $response->getHeader($header)[0];
            } else {
                $specs[$header] = null;
            }
        }

        $specs['server_time'] = $specs['Date'];
        unset($specs['Date']);

        return $specs;
    }

    /**
     * @param Crawler $crawler
     * @return array
     */
    private function getImages(Crawler $crawler): array
    {
        $images= array();
        // Get all img elements
        $imgElements = $crawler->filter('img');
        // If the class attribute exists and is not empty
        foreach ($imgElements as $element)
        {
            // Get the class attribute value
            $srcAttr = $element->getAttribute('src');
            if ($srcAttr) {
                // Split the class attribute value by whitespace to get the class names
                $srcNamesArray = explode(' ', $srcAttr);

                // Loop through each class name
                foreach ($srcNamesArray as $srcName) {

                    // Add the class name to the array if it doesn't already exist
                    if (!in_array($srcName, $images)) {
                        $images[] = $srcName;
                    }
                }
            }
        }

        return $images;
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
     * @return string|false
     */
    private function normalizeUrl($url) :string|false
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

        // Validate the URL using filter_var
        $normalizedUrl = filter_var($url, FILTER_VALIDATE_URL);

        if ($normalizedUrl === false) {
            return false;
        }

        return "https://".parse_url($normalizedUrl, PHP_URL_HOST);

    }

    /**
     * @param array $links
     * @return array[]
     */
    private function categorizeLinks(array $links, string $url): array
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
                if (!in_array($link, $httpLinks)) {

                    $httpLinks[] = $link;
                }

            } else {
                if (!in_array($url.$link, $nonHttpLinks)) {
                    $checkSlash = substr($link, 0,1);
                    if ($checkSlash != "/"){
                        $link = "/".$link;
                    }
                    $nonHttpLinks[] = $url.$link;
                }
            }
        }

        return [
            'page_links' => $nonHttpLinks,
            'external_links' => $httpLinks,
        ];
    }


    /**
     * @param array $links
     * @param string $url
     * @return array
     */
    private function getImagesLinks(array $links, string $url ): array
    {
        $imagesLinks = array();
        foreach ($links as $link)
        {

            if (!str_contains($link, $url)){
                $checkSlash = substr($link, 0,1);
                if ($checkSlash != "/"){
                    $link = "/".$link;
                }
                $imagesLinks[] = $url.$link;
            } else {
                $imagesLinks[] = $link;
            }


        }
        return $imagesLinks;
    }






}
