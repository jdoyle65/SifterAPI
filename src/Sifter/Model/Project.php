<?php namespace Sifter\Model;

use Sifter\JsonObjectHelpers;
use Sifter\Request\CreateIssueRequestObject;
use Sifter\Resource\IssuesResource;
use Sifter\Sifter;
use Sifter\SifterCurl;

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
     * @param $name string Name of project
     * @param $primaryCompanyName string Company associated with project
     * @param $archived boolean Is project archived?
     * @param $url string Regular URL for project
     * @param $issuesUrl string Regular URL for issues associated with project
     * @param $milestonesUrl string Regular URL for milestones associated with project
     * @param $apiUrl string API URL for project
     * @param $apiIssuesUrl string API URL for issues associated with project
     * @param $apiMilestonesUrl string API URL for milestones associated with project
     * @param $apiCategoriesUrl string API URL for categories associated with project
     * @param $apiPeopleUrl string API URL for people associated with project
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
     * Get Sifter project ID
     * @return mixed
     */
    public function getId() {
        return preg_filter('/.*\/projects\/([0-9]*)/', '$1', $this->getUrl());
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
     *
     * @param SifterCurl $curl
     * @param array $options sort, filter, search, perPage, and page options. Get sorting and filtering code arrays
     * from Sifter::statuses() or Sifter::priorities(). You can sort by multiple values by passing
     * in an array for each option as well. For example, if you wanted to sort and filter by Open then Closed issues:
     *  $statusOptions = Sifter::statuses();
     *  $options = array(
     *                 'status' => array(
     *                          $statusOptions['Open'],
     *                          $statusOptions['Closed']
     *                     )
     *             )
     *
     *
     * @return IssuesResource
     * @throws \Exception
     */
    public function issues(SifterCurl $curl, array $options = array()) {
        $params = array();

        if(!empty($options)) {

            if(isset($options['status'])) {
                $statusOptions = $options['status'];
                if(is_array($statusOptions)) {
                    $statusParam = implode('-', $statusOptions);
                } else {
                    $statusParam = $statusOptions;
                }
                $params['s'] = $statusParam;
            }

            if(isset($options['priority'])) {
                $priorityOptions = $options['priority'];
                if(is_array($priorityOptions)) {
                    $priorityParam = implode('-', $priorityOptions);
                } else {
                    $priorityParam = $priorityOptions;
                }
                $params['p'] = $priorityParam;
            }

            if(isset($options['search'])) {
                $params['q'] = $options['search'];
            }

            if(isset($options['perPage']) && is_int($options['perPage'])) {
                $params['per_page'] = $options['perPage'];
            }
            if(isset($options['page']) && is_int($options['page'])) {
                $params['page'] = $options['page'];
            }
        }

        asort($params);

        $curl->get($this->apiIssuesUrl, $params);

        if($curl->error) {
            throw new \Exception('cURL GET failed with code '.$curl->error_code);
        } else {
            return IssuesResource::issuesResourceFromJson($curl->response);
        }
    }

    /**
     * Get an array of all milestones associated with project
     *
     * @param SifterCurl $curl
     *
     * @return array
     * @throws \Exception
     */
    public function milestones(SifterCurl $curl) {
        $curl->get($this->apiMilestonesUrl);

        if($curl->error) {
            throw new \Exception('cURL GET failed with code '.$curl->error_code);
        } else {
            return JsonObjectHelpers::toMilestonesArray($curl->response);
        }
    }

    /**
     * Get an array of all categories associated with project
     *
     * @param SifterCurl $curl
     *
     * @return array
     * @throws \Exception
     */
    public function categories(SifterCurl $curl) {
        $curl->get($this->apiCategoriesUrl);

        if($curl->error) {
            throw new \Exception('cURL GET failed with code '.$curl->error_code);
        } else {
            return JsonObjectHelpers::toCategoriesArray($curl->response);
        }
    }

    /**
     * Get an array of all people associated with project
     *
     * @param SiferCurl $curl
     *
     * @return array
     * @throws \Exception
     */
    public function people(SifterCurl $curl) {
        $curl->get($this->apiPeopleUrl);

        if($curl->error) {
            throw new \Exception('cURL GET failed with code '.$curl->error_code);
        } else {
            return JsonObjectHelpers::toPeopleArray($curl->response);
        }
    }

    public function createIssue(CreateIssueRequestObject $issue, SifterCurl $curl)
    {
        $url = $this->apiIssuesUrl;

        $curl->post($url, $issue->dataArray());

        if($curl->error) {
            throw new \Exception('cURL POST failed with code '
                .$curl->error_code.'.\n'
                .var_dump(json_decode($curl->response)));
        } else {
            $json = json_decode($curl->response);
            if(!isset($json->issue)) {
                throw new \Exception('No issue object was returned');
            }
            return JsonObjectHelpers::toIssue($json->issue);
        }
    }


}