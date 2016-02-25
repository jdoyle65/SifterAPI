<?php namespace Sifter;




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
        Sifter::curl()->get($url);

        if (Sifter::curl()->error) {
            throw new \Exception('cURL GET failed with code ' . Sifter::curl()->error_code);
        } else {
            $projects = JsonObjectHelpers::toProjectsArray(Sifter::curl()->response);
            return $projects;
        }
    }
}