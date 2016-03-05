<?php namespace Sifter;

use Curl\Curl;

/**
 * Class SifterCurl
 * @package Sifter
 */
class SifterCurl extends Curl {

    private $baseUrl = '';

    /**
     * SifterCurl constructor.
     * @param $apiKey string Your Sifter API Key
     * @param $apiSubdomain string Your Sifter subdomain (for example mycompany if you use https://mycompany.sifterapp.com)
     */
    public function __construct($apiKey, $apiSubdomain)
    {
        parent::__construct();
        $this->baseUrl = 'https://' . $apiSubdomain . '.sifterapp.com/api/';
        $this->setHeader('X-Sifter-Token', $apiKey);
        $this->setHeader('Accept', 'application/json');
    }

    /**
     * Get the base URL being called on each request
     * @return string
     */
    public function getBaseUrl() {
        return $this->baseUrl;
    }

}