<?php namespace Sifter;

class Sifter {

    private $apiKey;
    private $subdomain;
    private $apiUrl;
    private $apiHeaders;



    public function __construct($apiKey, $sifterSubdomain)
    {
        $this->apiKey = $apiKey;
        $this->subdomain = $sifterSubdomain;
        $this->apiUrl = 'https://'.$sifterSubdomain.'.sifterapp.com/api/';
        $this->apiHeaders = [
            'X-Sifter-Token: '.$apiKey,
            'Accept: application/json'
        ];
    }
}