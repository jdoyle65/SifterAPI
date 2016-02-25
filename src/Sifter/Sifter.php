<?php namespace Sifter;

use Curl\Curl;
use Sifter\Model\Project;

class Sifter
{
    static protected $curl = null;

    const PROJECTS_URL = 'projects';


    public function __construct(SifterCurl $curl = null)
    {
        self::$curl = $curl;
    }

    public static function curl() {
        return self::$curl;
    }

    private function projectUrl($projectId)
    {
        return Sifter::curl()->getBaseUrl().self::PROJECTS_URL . $projectId;
    }

    public function allProjects($all = false)
    {
        $url = Sifter::curl()->getBaseUrl().self::PROJECTS_URL;
        if($all) { $url.'?all=true'; }
        Sifter::curl()->get(Sifter::curl()->getBaseUrl().self::PROJECTS_URL);

        if (Sifter::curl()->error) {
            throw new \Exception('cURL GET failed with code ' . Sifter::curl()->error_code);
        } else {
            $projects = $this->jsonToProjects(json_decode(Sifter::curl()->response));
            return $projects;
        }
    }


    /*
     * HELPER FUNCTIONS
     */

    private function jsonToProjects($json)
    {
        $projects = [];
        if ( ! isset($json->projects) || ! is_array($json->projects)) {
            throw new \Exception('Projects were not returned');
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