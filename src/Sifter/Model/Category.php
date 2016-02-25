<?php namespace Sifter\Model;

class Category {

    private $name;
    private $issuesUrl;
    private $apiIssuesUrl;

    /**
     * Category constructor.
     * @param $name
     * @param $issuesUrl
     * @param $apiIssuesUrl
     */
    public function __construct($name, $issuesUrl, $apiIssuesUrl)
    {
        $this->name = $name;
        $this->issuesUrl = $issuesUrl;
        $this->apiIssuesUrl = $apiIssuesUrl;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getIssuesUrl()
    {
        return $this->issuesUrl;
    }

    /**
     * @return mixed
     */
    public function getApiIssuesUrl()
    {
        return $this->apiIssuesUrl;
    }




}