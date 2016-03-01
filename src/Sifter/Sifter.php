<?php namespace Sifter;


/**
 * Class Sifter
 * @package Sifter
 */
class Sifter
{
    static protected $curl = null;

    const PROJECTS_URL = 'projects';

    /**
     * Sifter constructor.
     * @param SifterCurl|null $curl The SifterCurl object you've set up to communicate with your API
     */
    public function __construct(SifterCurl $curl = null)
    {
        self::$curl = $curl;
    }

    /**
     * Get the SifterCurl object you've set up to communicate with your API
     * @return null|SifterCurl
     */
    public static function curl() {
        return self::$curl;
    }

    private function projectUrl($projectId)
    {
        return Sifter::curl()->getBaseUrl().self::PROJECTS_URL . $projectId;
    }

    /**
     * Get an array of current Projects
     * @param bool $all Get all projects?
     * @return array
     * @throws \Exception
     */
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