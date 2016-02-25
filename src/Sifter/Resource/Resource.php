<?php namespace Sifter\Resource;

abstract class Resource {
    private $page;
    private $perPage;
    private $totalPages;
    private $nextPageUrl;
    private $previousPageUrl;

    /**
     * Resource constructor.
     * @param $page
     * @param $perPage
     * @param $totalPages
     * @param $nextPageUrl
     * @param $previousPageUrl
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
     * @return mixed
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @return mixed
     */
    public function getPerPage()
    {
        return $this->perPage;
    }

    /**
     * @return mixed
     */
    public function getTotalPages()
    {
        return $this->totalPages;
    }

    /**
     * @return mixed
     */
    public function getNextPageUrl()
    {
        return $this->nextPageUrl;
    }

    /**
     * @return mixed
     */
    public function getPreviousPageUrl()
    {
        return $this->previousPageUrl;
    }
}