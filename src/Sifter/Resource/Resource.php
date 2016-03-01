<?php namespace Sifter\Resource;

/**
 * Class Resource
 * @package Sifter\Resource
 */
abstract class Resource {
    private $page;
    private $perPage;
    private $totalPages;
    private $nextPageUrl;
    private $previousPageUrl;

    /**
     * Resource constructor.
     * @param $page Current resource page
     * @param $perPage Number of resource items per page
     * @param $totalPages Total number pages for resource item
     * @param $nextPageUrl API URL to get next page of resource items
     * @param $previousPageUrl API URL to get previous page of resource items
     */
    public function __construct($page, $perPage, $totalPages, $nextPageUrl, $previousPageUrl)
    {
        $this->page = $page;
        $this->perPage = $perPage;
        $this->totalPages = $totalPages;
        $this->nextPageUrl = $nextPageUrl;
        $this->previousPageUrl = $previousPageUrl;
    }

    abstract function nextPage();
    abstract function previousPage();

    /**
     * Get current page number
     * @return mixed
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * Get number of resource items per page
     * @return mixed
     */
    public function getPerPage()
    {
        return $this->perPage;
    }

    /**
     * Get total count of resource item pages
     * @return mixed
     */
    public function getTotalPages()
    {
        return $this->totalPages;
    }

    /**
     * Get API URL used to retrieve next page of resource items
     * @return string|null
     */
    public function getNextPageUrl()
    {
        return $this->nextPageUrl;
    }

    /**
     * Get API URL used to retrieve previous page of resource items
     * @return string|null
     */
    public function getPreviousPageUrl()
    {
        return $this->previousPageUrl;
    }
}