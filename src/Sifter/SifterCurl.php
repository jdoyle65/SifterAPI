<?php namespace Sifter;

use Curl\Curl;

class SifterCurl extends Curl {

    private $baseUrl = '';

    public function __construct($apiKey, $apiSubdomain)
    {
        parent::__construct();
        $this->baseUrl = 'https://' . $apiSubdomain . '.sifterapp.com/api/';
        $this->setHeader('X-Sifter-Token', $apiKey);
        $this->setHeader('Accept', 'application/json');
    }

    public function getBaseUrl() {
        return $this->baseUrl;
    }
}