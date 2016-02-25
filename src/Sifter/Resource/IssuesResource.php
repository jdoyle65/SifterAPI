<?php namespace Sifter\Resource;

use Sifter\JsonObjectHelpers;
use Sifter\Model\Issue;
use Sifter\Sifter;

class IssuesResource extends Resource {
    /**
     * @var array
     */
    private $issues;


    /**
     * IssuesResource constructor.
     * @param array $issues
     * @param $page
     * @param $perPage
     * @param $totalPages
     * @param $nextPageUrl
     * @param $previousPageUrl
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
     * @return array
     */
    public function get() {
        return $this->issues;
    }


    /**
     * @return mixed
     */
    public function first() {
        return $this->issues[0];
    }

    /**
     * @return bool|IssuesResource
     * @throws \Exception
     */
    public function nextPage()
    {
        if(parent::getNextPageUrl() == null) {
            return false;
        } else {
            return $this->changePage(parent::getNextPageUrl());
        }
    }

    /**
     * @return bool|IssuesResource
     * @throws \Exception
     */
    public function previousPage()
    {
        if(parent::getPreviousPageUrl() == null) {
            return false;
        } else {
            return $this->changePage(parent::getPreviousPageUrl());
        }
    }

    /**
     * @param $json
     * @return IssuesResource
     */
    public static function issuesResourceFromJson($json) {
        return JsonObjectHelpers::toIssuesResource($json);
    }

    /**
     * @param $pageUrl
     * @return IssuesResource
     * @throws \Exception
     */
    private function changePage($pageUrl) {
        $curl = Sifter::curl();
        $curl->get($pageUrl);

        if($curl->error) {
            throw new \Exception('cURL GET failed with code '.$curl->error_code);
        } else {
           return JsonObjectHelpers::toIssuesResource($curl->response);
        }
    }


}