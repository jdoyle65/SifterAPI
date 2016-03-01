<?php namespace Sifter\Model;

use Sifter\JsonObjectHelpers;
use Sifter\Resource\IssuesResource;
use Sifter\Sifter;

/**
 * Class Project
 * @package Sifter\Model
 */
class Project {
    private $name;
    private $primaryCompanyName;
    private $archived;
    private $url;
    private $issuesUrl;
    private $milestonesUrl;
    private $apiUrl;
    private $apiIssuesUrl;
    private $apiMilestonesUrl;
    private $apiCategoriesUrl;
    private $apiPeopleUrl;

    /**
     * Project constructor.
     * @param $name Name of project
     * @param $primaryCompanyName Company associated with project
     * @param $archived Is project archived?
     * @param $url Regular URL for project
     * @param $issuesUrl Regular URL for issues associated with project
     * @param $milestonesUrl Regular URL for milestones associated with project
     * @param $apiUrl API URL for project
     * @param $apiIssuesUrl API URL for issues associated with project
     * @param $apiMilestonesUrl API URL for milestones associated with project
     * @param $apiCategoriesUrl API URL for categories associated with project
     * @param $apiPeopleUrl API URL for people associated with project
     */
    public function __construct($name, $primaryCompanyName, $archived, $url, $issuesUrl, $milestonesUrl, $apiUrl, $apiIssuesUrl, $apiMilestonesUrl, $apiCategoriesUrl, $apiPeopleUrl)
    {
        $this->name = $name;
        $this->primaryCompanyName = $primaryCompanyName;
        $this->archived = $archived;
        $this->url = $url;
        $this->issuesUrl = $issuesUrl;
        $this->milestonesUrl = $milestonesUrl;
        $this->apiUrl = $apiUrl;
        $this->apiIssuesUrl = $apiIssuesUrl;
        $this->apiMilestonesUrl = $apiMilestonesUrl;
        $this->apiCategoriesUrl = $apiCategoriesUrl;
        $this->apiPeopleUrl = $apiPeopleUrl;
    }


    /**
     * Get project name
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get name of company associated with project
     * @return string
     */
    public function getPrimaryCompanyName()
    {
        return $this->primaryCompanyName;
    }

    /**
     * Get is archived
     * @return mixed
     */
    public function getArchived()
    {
        return $this->archived;
    }

    /**
     * Get regular URL for project
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Get regular URL for issues associated with project
     * @return string
     */
    public function getIssuesUrl()
    {
        return $this->issuesUrl;
    }

    /**
     * Get regular URL for milestones associated with project
     * @return string
     */
    public function getMilestonesUrl()
    {
        return $this->milestonesUrl;
    }

    /**
     * Get an IssueResource containing issues associated with project
     * @return IssuesResource
     * @throws \Exception
     */
    public function issues() {
        $curl = Sifter::curl();
        $curl->get($this->apiIssuesUrl);

        if($curl->error) {
            throw new \Exception('cURL GET failed with code '.$curl->error_code);
        } else {
            return IssuesResource::issuesResourceFromJson($curl->response);
        }
    }

    /**
     * Get an array of all milestones associated with project
     * @return array
     * @throws \Exception
     */
    public function milestones() {
        $curl = Sifter::curl();
        $curl->get($this->apiMilestonesUrl);

        if($curl->error) {
            throw new \Exception('cURL GET failed with code '.$curl->error_code);
        } else {
            return JsonObjectHelpers::toMilestonesArray($curl->response);
        }
    }

    /**
     * Get an array of all categories associated with project
     * @return array
     * @throws \Exception
     */
    public function categories() {
        $curl = Sifter::curl();
        $curl->get($this->apiCategoriesUrl);

        if($curl->error) {
            throw new \Exception('cURL GET failed with code '.$curl->error_code);
        } else {
            return JsonObjectHelpers::toCategoriesArray($curl->response);
        }
    }

    /**
     * Get an array of all people associated with project
     * @return array
     * @throws \Exception
     */
    public function people() {
        $curl = Sifter::curl();
        $curl->get($this->apiPeopleUrl);

        if($curl->error) {
            throw new \Exception('cURL GET failed with code '.$curl->error_code);
        } else {
            return JsonObjectHelpers::toPeopleArray($curl->response);
        }
    }


}