<?php namespace Sifter;

use Curl\Curl;

/**
 * Class SifterCurl
 * @package Sifter
 */
class SifterCurl extends Curl {

    /**
     * @var string
     */
    private $baseUrl = '';

    /**
     * SifterCurl constructor.
     * @param $apiKey
     * @param $apiSubdomain
     */
    public function __construct($apiKey, $apiSubdomain)
    {
        parent::__construct();
        $this->baseUrl = 'https://' . $apiSubdomain . '.sifterapp.com/api/';
        $this->setHeader('X-Sifter-Token', $apiKey);
        $this->setHeader('Accept', 'application/json');
    }

    /**
     * @return string
     */
    public function getBaseUrl() {
        return $this->baseUrl;
    }

}