<?php namespace Sifter\Model;

class Person {
    private $username;
    private $firstName;
    private $lastName;
    private $email;
    private $issuesUrl;
    private $apiIssuesUrl;

    /**
     * Person constructor.
     * @param $username
     * @param $firstName
     * @param $lastName
     * @param $email
     * @param $issuesUrl
     * @param $apiIssuesUrl
     */
    public function __construct($username, $firstName, $lastName, $email, $issuesUrl, $apiIssuesUrl)
    {
        $this->username = $username;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->issuesUrl = $issuesUrl;
        $this->apiIssuesUrl = $apiIssuesUrl;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getIssuesUrl()
    {
        return $this->issuesUrl;
    }

    /**
     * @return mixed
     */
    public function getApiIssuesUrl()
    {
        return $this->apiIssuesUrl;
    }



}