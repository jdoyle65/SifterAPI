<?php namespace Sifter\Resource;

use Sifter\Model\Issue;

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
        $issueObjects = [];
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
        if(is_string($json)) {
            $json = json_decode($json);
        }
        return new IssuesResource(
            $json->issues,
            $json->page,
            $json->per_page,
            $json->total_pages,
            $json->next_page_url,
            $json->previous_page_url
        );
    }

    /**
     * @param $pageUrl
     * @return IssuesResource
     * @throws \Exception
     */
    private function changePage($pageUrl) {
        $curl = SifterCurl::instance()->getCurl();
        $curl->get($pageUrl);

        if($curl->error) {
            throw new \Exception('cURL GET failed with code '.$curl->error_code);
        } else {
            $json = json_decode($curl->response);
            return new IssuesResource(
                $json->issues,
                $json->page,
                $json->per_page,
                $json->total_pages,
                $json->next_page_url,
                $json->previous_page_url
            );
        }
    }


}