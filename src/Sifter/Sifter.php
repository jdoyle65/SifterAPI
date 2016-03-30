<?php namespace Sifter;


/**
 * Class Sifter
 * @package Sifter
 */
class Sifter
{
    protected $curl = null;
    static protected $statuses = null;
    static protected $priorities = null;

    const PROJECTS_URL = 'projects';

    /**
     * Sifter constructor.
     * @param SifterCurl|null $curl The SifterCurl object you've set up to communicate with your API
     */
    public function __construct(SifterCurl $curl = null)
    {
        $this->curl = $curl;
    }

    /**
     * Get the SifterCurl object you've set up to communicate with your API
     * @return null|SifterCurl
     */
    public function curl() {
        return $this->curl;
    }

    private function projectUrl($projectId)
    {
        return $this->curl->getBaseUrl().self::PROJECTS_URL . $projectId;
    }

    /**
     * Get an array of current Projects
     * @param $withArchived boolean Include archived projects
     * @return array
     * @throws \Exception
     */
    public function allProjects($withArchived = false)
    {
        $url = $this->curl->getBaseUrl().self::PROJECTS_URL;
        if($withArchived) { $url.'?all=true'; }
        $this->curl->get($url);

        if ($this->curl->error) {
            throw new \Exception('cURL GET failed with code ' . $this->curl->error_code);
        } else {
            $projects = JsonObjectHelpers::toProjectsArray($this->curl->response);
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
     * @param SifterCurl $curl
     *
     * @return array
     * @throws \Exception
     */
    private static function buildStatuses(SifterCurl $curl) {
        $url = $curl->getBaseUrl() . 'statuses';
        $curl->get($url);

        if ($curl->error) {
            throw new \Exception('cURL GET failed with code ' . $curl->error_code);
        } else {
            $statuses = JsonObjectHelpers::toStatusArray($curl->response);
            return $statuses;
        }
    }

    /**
     * Get an associative array of allowed priorities from Sifter's API (key = priority_name, value = id_number)
     * @param SifterCurl $curl
     *
     * @return array
     * @throws \Exception
     */
    private static function buildPriorities(SifterCurl $curl) {
        $url = $curl->getBaseUrl() . 'priorities';
        $curl->get($url);

        if ($curl->error) {
            throw new \Exception('cURL GET failed with code ' . $curl->error_code);
        } else {
            $priorities = JsonObjectHelpers::toPriorityArray($curl->response);
            return $priorities;
        }
    }
}