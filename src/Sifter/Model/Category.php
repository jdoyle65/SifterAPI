<?php namespace Sifter\Model;

/**
 * Class Category
 * @package Sifter\Model
 */
class Category {

    private $name;
    private $issuesUrl;
    private $apiIssuesUrl;

    /**
     * Category constructor.
     * @param $name string Name of the category
     * @param $issuesUrl string Category's regular Sifter URL
     * @param $apiIssuesUrl string Category's Sifter API URL
     */
    public function __construct($name, $issuesUrl, $apiIssuesUrl)
    {
        $this->name = $name;
        $this->issuesUrl = $issuesUrl;
        $this->apiIssuesUrl = $apiIssuesUrl;
    }

    /**
     * Get category's name
     * @return string Category name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get category's regular Sifter URL
     * @return string Sifter URL
     */
    public function getIssuesUrl()
    {
        return $this->issuesUrl;
    }

    /**
     * Get category's Sifter API URL
     * @return string Sifter API URL
     */
    public function getApiIssuesUrl()
    {
        return $this->apiIssuesUrl;
    }




}