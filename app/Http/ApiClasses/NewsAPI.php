<?php

namespace App\Http\ApiClasses;

use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;

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
        ?string $query = "" ,
        ?string $language  ="pt" ,
        ?string $country ="pt" ,
        ?string $category ="technology"): array
    {
        $country = $country ?? 'pt';
        $language = $language ?? 'pt';
        $category = $category ?? 'technology';

        $url = $this->apiUrl . "/1/news?apikey=" . $this->newsApiToken
            . "&q=" . $query
            . "&language=" . $language
            . "&country=". $country
            . "&category=". $category;


        Log::channel('newsAPI')->info($url.' -- '.now());
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


    /**
     * @return string[]
     */
    public function languagesArray():array
    {
        return array(
            'be' => 'Belarusian',
            'af' => 'Afrikaans',
            'sq' => 'Albanian',
            'am' => 'Amharic',
            'ar' => 'Arabic',
            'az' => 'Azerbaijani',
            'bn' => 'Bengali',
            'bs' => 'Bosnian',
            'bg' => 'Bulgarian',
            'my' => 'Burmese',
            'ckb' => 'Central Kurdish',
            'zh' => 'Chinese',
            'hr' => 'Croatian',
            'cs' => 'Czech',
            'da' => 'Danish',
            'nl' => 'Dutch',
            'en' => 'English',
            'et' => 'Estonian',
            'pi' => 'Filipino',
            'fi' => 'Finnish',
            'fr' => 'French',
            'ka' => 'Georgian',
            'de' => 'German',
            'el' => 'Greek',
            'he' => 'Hebrew',
            'hi' => 'Hindi',
            'hu' => 'Hungarian',
            'is' => 'Icelandic',
            'in' => 'Indonesian',
            'it' => 'Italian',
            'jp' => 'Japanese',
            'kh' => 'Khmer',
            'rw' => 'Kinyarwanda',
            'ko' => 'Korean',
            'lv' => 'Latvian',
            'lt' => 'Lithuanian',
            'lb' => 'Luxembourgish',
            'mk' => 'Macedonian',
            'ms' => 'Malay',
            'mt' => 'Maltese',
            'mi' => 'Maori',
            'mn' => 'Mongolian',
            'ne' => 'Nepali',
            'no' => 'Norwegian',
            'ps' => 'Pashto',
            'fa' => 'Persian',
            'pl' => 'Polish',
            'pt' => 'Portuguese',
            'ro' => 'Romanian',
            'ru' => 'Russian',
            'sm' => 'Samoan',
            'sr' => 'Serbian',
            'sn' => 'Shona',
            'si' => 'Sinhala',
            'sk' => 'Slovak',
            'sl' => 'Slovenian',
            'so' => 'Somali',
            'es' => 'Spanish',
            'sw' => 'Swahili',
            'sv' => 'Swedish',
            'tg' => 'Tajik',
            'ta' => 'Tamil',
            'th' => 'Thai',
            'tr' => 'Turkish',
            'tk' => 'Turkmen',
            'uk' => 'Ukrainian',
            'ur' => 'Urdu',
            'uz' => 'Uzbek',
            'vi' => 'Vietnamese'
        );

    }

    /**
     * @return string[]
     */
    public function countriesArray(): array
    {
        return  array(
            'af' => 'Afghanistan',
            'al' => 'Albania',
            'dz' => 'Algeria',
            'ao' => 'Angola',
            'ar' => 'Argentina',
            'au' => 'Australia',
            'at' => 'Austria',
            'az' => 'Azerbaijan',
            'bh' => 'Bahrain',
            'bd' => 'Bangladesh',
            'bb' => 'Barbados',
            'by' => 'Belarus',
            'be' => 'Belgium',
            'bm' => 'Bermuda',
            'bt' => 'Bhutan',
            'bo' => 'Bolivia',
            'ba' => 'Bosnia And Herzegovina',
            'br' => 'Brazil',
            'bn' => 'Brunei',
            'bg' => 'Bulgaria',
            'bf' => 'Burkina Faso',
            'kh' => 'Cambodia',
            'cm' => 'Cameroon',
            'ca' => 'Canada',
            'cv' => 'Cape Verde',
            'ky' => 'Cayman Islands',
            'cl' => 'Chile',
            'cn' => 'China',
            'co' => 'Colombia',
            'km' => 'Comoros',
            'cr' => 'Costa Rica',
            'ci' => "Côte d'Ivoire",
            'hr' => 'Croatia',
            'cu' => 'Cuba',
            'cy' => 'Cyprus',
            'cz' => 'Czech Republic',
            'dk' => 'Denmark',
            'dj' => 'Djibouti',
            'dm' => 'Dominica',
            'do' => 'Dominican Republic',
            'cd' => 'DR Congo',
            'ec' => 'Ecuador',
            'eg' => 'Egypt',
            'sv' => 'El Salvador',
            'ee' => 'Estonia',
            'et' => 'Ethiopia',
            'fj' => 'Fiji',
            'fi' => 'Finland',
            'fr' => 'France',
            'pf' => 'French Polynesia',
            'ga' => 'Gabon',
            'ge' => 'Georgia',
            'de' => 'Germany',
            'gh' => 'Ghana',
            'gr' => 'Greece',
            'gt' => 'Guatemala',
            'gn' => 'Guinea',
            'ht' => 'Haiti',
            'hn' => 'Honduras',
            'hk' => 'Hong Kong',
            'hu' => 'Hungary',
            'is' => 'Iceland',
            'in' => 'India',
            'id' => 'Indonesia',
            'iq' => 'Iraq',
            'ie' => 'Ireland',
            'il' => 'Israel',
            'it' => 'Italy',
            'jm' => 'Jamaica',
            'jp' => 'Japan',
            'jo' => 'Jordan',
            'kz' => 'Kazakhstan',
            'ke' => 'Kenya',
            'kw' => 'Kuwait',
            'kg' => 'Kyrgyzstan',
            'lv' => 'Latvia',
            'lb' => 'Lebanon',
            'ly' => 'Libya',
            'lt' => 'Lithuania',
            'lu' => 'Luxembourg',
            'mo' => 'Macau',
            'mk' => 'Macedonia',
            'mg' => 'Madagascar',
            'mw' => 'Malawi',
            'my' => 'Malaysia',
            'mv' => 'Maldives',
            'ml' => 'Mali',
            'mt' => 'Malta',
            'mr' => 'Mauritania',
            'mx' => 'Mexico',
            'md' => 'Moldova',
            'mn' => 'Mongolia',
            'me' => 'Montenegro',
            'ma' => 'Morocco',
            'mz' => 'Mozambique',
            'mm' => 'Myanmar',
            'na' => 'Namibia',
            'np' => 'Nepal',
            'nl' => 'Netherlands',
            'nz' => 'New Zealand',
            'ne' => 'Niger',
            'ng' => 'Nigeria',
            'kp' => 'North Korea',
            'no' => 'Norway',
            'om' => 'Oman',
            'pk' => 'Pakistan',
            'pa' => 'Panama',
            'py' => 'Paraguay',
            'pe' => 'Peru',
            'ph' => 'Philippines',
            'pl' => 'Poland',
            'pt' => 'Portugal',
            'pr' => 'Puerto Rico',
            'ro' => 'Romania',
            'ru' => 'Russia',
            'rw' => 'Rwanda',
            'ws' => 'Samoa',
            'sm' => 'San Marino',
            'sa' => 'Saudi Arabia',
            'sn' => 'Senegal',
            'rs' => 'Serbia',
            'sg' => 'Singapore',
            'sk' => 'Slovakia',
            'si' => 'Slovenia',
            'sb' => 'Solomon Islands',
            'so' => 'Somalia',
            'za' => 'South Africa',
            'kr' => 'South Korea',
            'es' => 'Spain',
            'lk' => 'Sri Lanka',
            'sd' => 'Sudan',
            'se' => 'Sweden',
            'ch' => 'Switzerland',
            'sy' => 'Syria',
            'tw' => 'Taiwan',
            'tj' => 'Tajikistan',
            'tz' => 'Tanzania',
            'th' => 'Thailand',
            'to' => 'Tonga',
            'tn' => 'Tunisia',
            'tr' => 'Turkey',
            'tm' => 'Turkmenistan',
            'ug' => 'Uganda',
            'ua' => 'Ukraine',
            'ae' => 'United Arab Emirates',
            'gb' => 'United Kingdom',
            'us' => 'United States of America',
            'uy' => 'Uruguay',
            'uz' => 'Uzbekistan',
            've' => 'Venezuela',
            'vi' => 'Vietnam',
            'ye' => 'Yemen',
            'zm' => 'Zambia',
            'zw' => 'Zimbabwe'
        );

    }
}
