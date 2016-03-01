<?php namespace Sifter\Model;

use Carbon\Carbon;

/**
 * Class Milestone
 * @package Sifter\Model
 */
class Milestone {
    private $name;
    private $dueDate;
    private $issuesUrl;
    private $apiIssuesUrl;

    /**
     * Milestone constructor.
     * @param $name Name of milestone
     * @param $dueDate Date milestone must be completed
     * @param $issuesUrl regular URL for issues attached to milestone
     * @param $apiIssuesUrl API URL for issues attached to milestone
     */
    public function __construct($name, $dueDate, $issuesUrl, $apiIssuesUrl)
    {
        $this->name = $name;
        $this->dueDate = new Carbon($dueDate);
        $this->issuesUrl = $issuesUrl;
        $this->apiIssuesUrl = $apiIssuesUrl;
    }

    /**
     * Get milestone name
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get date milestone must be completed by
     * @return Carbon
     */
    public function getDueDate()
    {
        return $this->dueDate->copy();
    }

    /**
     * Get regular URL for issues attached to this milestone
     * @return string
     */
    public function getIssuesUrl()
    {
        return $this->issuesUrl;
    }

    /**
     * Get API URL for issues attached to this milestone
     * @return string
     */
    public function getApiIssuesUrl()
    {
        return $this->apiIssuesUrl;
    }




}