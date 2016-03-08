<?php namespace Sifter;


/**
 * Class Sifter
 * @package Sifter
 */
class Sifter
{
    static protected $curl = null;
    static protected $statuses = null;
    static protected $priorities = null;

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
        return Sifter::curl()->getBaseUrl() . self::PROJECTS_URL . $projectId;
    }

    /**
     * Get an array of current Projects
     * @param $withArchived boolean Include archived projects
     * @return array
     * @throws \Exception
     */
    public function allProjects($withArchived = false)
    {
        $url = Sifter::curl()->getBaseUrl().self::PROJECTS_URL;
        if($withArchived) { $url.'?all=true'; }
        Sifter::curl()->get($url);

        if (Sifter::curl()->error) {
            throw new \Exception('cURL GET failed with code ' . Sifter::curl()->error_code);
        } else {
            $projects = JsonObjectHelpers::toProjectsArray(Sifter::curl()->response);
            return $projects;
        }
    }


    /**
     * An array of status key values.
     * @return array
     * @throws \Exception
     */
    public static function statuses()
    {
        if(self::$statuses === null) {
            self::$statuses = self::buildStatuses();
        }
        return self::$statuses;
    }

    /**
     * An array of priority key values.
     * @return array
     * @throws \Exception
     */
    public static function priorities()
    {
        if(self::$priorities === null) {
            self::$priorities = self::buildPriorities();
        }
        return self::$priorities;
    }

    /**
     * Get an associative array of allowed statuses from Sifter's API (key = status_name, value = id_number)
     * @return array
     * @throws \Exception
     */
    private static function buildStatuses() {
        $url = Sifter::curl()->getBaseUrl() . 'statuses';
        Sifter::curl()->get($url);

        if (Sifter::curl()->error) {
            throw new \Exception('cURL GET failed with code ' . Sifter::curl()->error_code);
        } else {
            $statuses = JsonObjectHelpers::toStatusArray(Sifter::curl()->response);
            return $statuses;
        }
    }

    /**
     * Get an associative array of allowed priorities from Sifter's API (key = priority_name, value = id_number)
     * @return array
     * @throws \Exception
     */
    private static function buildPriorities() {
        $url = Sifter::curl()->getBaseUrl() . 'priorities';
        Sifter::curl()->get($url);

        if (Sifter::curl()->error) {
            throw new \Exception('cURL GET failed with code ' . Sifter::curl()->error_code);
        } else {
            $priorities = JsonObjectHelpers::toPriorityArray(Sifter::curl()->response);
            return $priorities;
        }
    }
}
