<?php

namespace Acme;

use Symfony\Component\BrowserKit\AbstractBrowser;
use Symfony\Component\BrowserKit\Response;

class Client extends AbstractBrowser
{
    protected function doRequest($request)
    {
        // ... convert request into a response

//        return new Response($content, $status, $headers);
    }
}
