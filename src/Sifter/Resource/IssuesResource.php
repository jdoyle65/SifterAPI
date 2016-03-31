<?php namespace Sifter\Resource;

use Sifter\JsonObjectHelpers;
use Sifter\Model\Issue;
use Sifter\Sifter;
use Sifter\SifterCurl;

/**
 * Class IssuesResource
 * @package Sifter\Resource
 */
class IssuesResource extends Resource {
    /**
     * @var array
     */
    private $issues;


    /**
     * IssuesResource constructor.
     * @param $issues array Array of issues to be placed in resource
     * @param $page int Current page of issues held by resource
     * @param $perPage int Current number of issues per page held by resource
     * @param $totalPages int Total number of pages of issues
     * @param $nextPageUrl string API URL to retrieve next page of issues
     * @param $previousPageUrl string API URL to retrieve previous page of issues
     */
    public function __construct(array $issues, $page, $perPage, $totalPages, $nextPageUrl, $previousPageUrl)
    {
        parent::__construct($page, $perPage, $totalPages, $nextPageUrl, $previousPageUrl);
        $issueObjects = array();
        foreach($issues as $issue) {
            $issueObjects[] = new Issue(
                $issue->number,
                $issue->category_name,
                $issue->priority,
                $issue->subject,
                $issue->description,
                $issue->milestone_name,
                $issue->opener_name,
                $issue->opener_email,
                $issue->assignee_name,
                $issue->assignee_email,
                $issue->status,
                $issue->comment_count,
                $issue->attachment_count,
                $issue->created_at,
                $issue->updated_at,
                $issue->url,
                $issue->api_url
            );
        }
        $this->issues = $issueObjects;
    }

    /**
     * Get the array of issues held by this resource
     * @return array
     */
    public function get() {
        return $this->issues;
    }


    /**
     * Get the first issue held by this resource
     * @return mixed
     */
    public function first() {
        return $this->issues[0];
    }

    /**
     * Get an IssueResource containing the next page of issues, else return false if no next page
     *
     * @param SifterCurl $curl
     *
     * @return bool|IssuesResource
     * @throws \Exception
     */
    public function nextPage(SifterCurl $curl)
    {
        if(parent::getNextPageUrl() == null) {
            return false;
        } else {
            return $this->changePage(parent::getNextPageUrl(), $curl);
        }
    }

    /**
     * Get an IssueResource containing the previous page of issues, else return false if no previous page
     *
     * @param SifterCurl $curl
     *
     * @return bool|IssuesResource
     * @throws \Exception
     */
    public function previousPage(SifterCurl $curl)
    {
        if(parent::getPreviousPageUrl() == null) {
            return false;
        } else {
            return $this->changePage(parent::getPreviousPageUrl(), $curl);
        }
    }

    /**
     * Build an IssueResource from the passed JSON
     * @param $json JSON object
     * @return IssuesResource
     */
    public static function issuesResourceFromJson($json) {
        return JsonObjectHelpers::toIssuesResource($json);
    }

    /**
     * Helper function to go to the page requested by the pageUrl
     *
     * @param $pageUrl
     * @param SifterCurl $curl
     *
     * @return IssuesResource
     * @throws \Exception
     */
    private function changePage($pageUrl, SifterCurl $curl) {
        $curl->get($pageUrl);

        if($curl->error) {
            throw new \Exception('cURL GET failed with code '.$curl->error_code);
        } else {
           return JsonObjectHelpers::toIssuesResource($curl->response);
        }
    }


}