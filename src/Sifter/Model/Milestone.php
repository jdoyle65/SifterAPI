<?php namespace Sifter\Model;

use Carbon\Carbon;

class Milestone {
    private $name;
    private $dueDate;
    private $issuesUrl;
    private $apiIssuesUrl;

    /**
     * Milestone constructor.
     * @param $name
     * @param $dueDate
     * @param $issuesUrl
     * @param $apiIssuesUrl
     */
    public function __construct($name, $dueDate, $issuesUrl, $apiIssuesUrl)
    {
        $this->name = $name;
        $this->dueDate = new Carbon($dueDate);
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
    public function getDueDate()
    {
        return $this->dueDate->copy();
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