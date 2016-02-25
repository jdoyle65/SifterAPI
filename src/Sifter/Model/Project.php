<?php namespace Sifter\Model;

use Sifter\JsonObjectHelpers;
use Sifter\Resource\IssuesResource;
use Sifter\Sifter;


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
     * @param $name
     * @param $primaryCompanyName
     * @param $archived
     * @param $url
     * @param $issuesUrl
     * @param $milestonesUrl
     * @param $apiUrl
     * @param $apiIssuesUrl
     * @param $apiMilestonesUrl
     * @param $apiCategoriesUrl
     * @param $apiPeopleUrl
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
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getPrimaryCompanyName()
    {
        return $this->primaryCompanyName;
    }

    /**
     * @return mixed
     */
    public function getArchived()
    {
        return $this->archived;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
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
    public function getMilestonesUrl()
    {
        return $this->milestonesUrl;
    }

    public function issues() {
        $curl = Sifter::curl();
        $curl->get($this->apiIssuesUrl);

        if($curl->error) {
            throw new \Exception('cURL GET failed with code '.$curl->error_code);
        } else {
            return IssuesResource::issuesResourceFromJson($curl->response);
        }
    }

    public function milestones() {
        $curl = Sifter::curl();
        $curl->get($this->apiMilestonesUrl);

        if($curl->error) {
            throw new \Exception('cURL GET failed with code '.$curl->error_code);
        } else {
            return JsonObjectHelpers::toMilestonesArray($curl->response);
        }
    }

    public function categories() {
        $curl = Sifter::curl();
        $curl->get($this->apiCategoriesUrl);

        if($curl->error) {
            throw new \Exception('cURL GET failed with code '.$curl->error_code);
        } else {
            return JsonObjectHelpers::toCategoriesArray($curl->response);
        }
    }

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