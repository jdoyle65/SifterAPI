<?php namespace Sifter;

use Curl\Curl;

class SifterCurl {
    private static $instance;
    private $apiKey;
    private $apiSubdomain;
    private $curl;

    public static function instance()
    {
        if (static::$instance === null) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    public function setApiInformation($apiKey, $apiSubdomain) {
        $this->apiKey = $apiKey;
        $this->apiSubdomain = $apiSubdomain;
        $this->curl = new Curl();
        $this->curl->setHeader('X-Sifter-Token', $apiKey);
        $this->curl->setHeader('Accept', 'application/json');
    }

    public function getCurl() {
        return $this->curl;
    }


    protected function __construct()
    {
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }
}