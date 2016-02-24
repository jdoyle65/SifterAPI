<?php namespace Sifter;

use Curl\Curl;

class Sifter
{
    private $apiBaseUrl;
    private $apiHeaders;
    private $curl;

    private $PROJECTS_URL = 'projects/';


    public function __construct($apiKey, $sifterSubdomain)
    {
        $this->apiKey = $apiKey;
        $this->subdomain = $sifterSubdomain;
        $this->apiBaseUrl = 'https://' . $sifterSubdomain . '.sifterapp.com/api/';
        $sifterCurl = SifterCurl::instance();
        $sifterCurl->setApiInformation($apiKey, $sifterSubdomain);
        $this->curl = $sifterCurl->getCurl();
    }

    private function allProjectsUrl()
    {
        return $this->apiBaseUrl . $this->PROJECTS_URL;
    }

    private function projectUrl($projectId)
    {
        return $this->apiBaseUrl . $this->PROJECTS_URL . $projectId;
    }

    /**
     * @return string
     */
    public function getApiBaseUrl()
    {
        return $this->apiBaseUrl;
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        return $this->apiHeaders;
    }

    public function getHeader($header)
    {
        if (isset($this->apiHeaders[$header])) {
            return $this->apiHeaders[$header];
        } else {
            return null;
        }
    }

    public function allProjects()
    {
        $url = $this->allProjectsUrl();
        $this->curl->get($url);

        if ($this->curl->error) {
            return $this->curl->error_code;
        } else {
            $projects = [];
            $json = json_decode($this->curl->response);
            if ( ! isset($json->projects) || ! is_array($json->projects)) {
                throw new Exception('Projects were not returned');
            } else {
                foreach ($json->projects as $project) {
                    $projects[] = new Project(
                        $project->name,
                        $project->primary_company_name,
                        $project->archived,
                        $project->url,
                        $project->issues_url,
                        $project->milestones_url,
                        $project->api_url,
                        $project->api_issues_url,
                        $project->api_milestones_url,
                        $project->api_categories_url,
                        $project->api_people_url
                    );
                }

                return $projects;
            }
        }
    }


}