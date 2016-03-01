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
     * @param $username Username
     * @param $firstName First name
     * @param $lastName Last name
     * @param $email Email
     * @param $issuesUrl Regular URL for issues assigned to user
     * @param $apiIssuesUrl API URL for issues assigned to user
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
     * Get username
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Get first name
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Get last name
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Get full name
     * @return string
     */
    public function getFullName()
    {
        return $this->firstName . ' ' . $this->lastName;
    }

    /**
     * Get email
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get regular URL for issues assigned to user
     * @return string
     */
    public function getIssuesUrl()
    {
        return $this->issuesUrl;
    }

    /**
     * Get API URL for issues assigned to user
     * @return string
     */
    public function getApiIssuesUrl()
    {
        return $this->apiIssuesUrl;
    }



}