<?php

namespace App\Http\ApiClasses;
use GuzzleHttp\Client;
class ClientAPI
{

    public Client $client;

    public function __construct()
    {
        $this->client = new Client();
    }

}
