<?php namespace Sifter\Model;

use Carbon\Carbon;

/**
 * Class Issue
 * @package Sifter\Model
 */
class Issue {

    private $number;
    private $categoryName;
    private $priority;
    private $subject;
    private $description;
    private $milestoneName;
    private $openerName;
    private $openerEmail;
    private $assigneeName;
    private $assigneeEmail;
    private $status;
    private $commentCount;
    private $attachmentCount;
    private $createdAt;
    private $updatedAt;
    private $url;
    private $apiUrl;


    /**
     * Issue constructor.
     * @param $number Issue number
     * @param $categoryName Name of issue's category
     * @param $priority Issue priority
     * @param $subject Subject line
     * @param $description Description of issue
     * @param $milestoneName Associated milestone
     * @param $openerName Person who opened the issue
     * @param $openerEmail Email of person who opened the issue
     * @param $assigneeName Person assigned this issue
     * @param $assigneeEmail Email of person assigned this issue
     * @param $status Status of the issue
     * @param $commentCount Number of comments attached to issue
     * @param $attachmentCount Number of attachments attached to issue
     * @param $createdAt Date issue created at
     * @param $updatedAt Date issue modified at
     * @param $url Issue's regular Sifter URL
     * @param $apiUrl Issue's Sifter API URL
     */
    public function __construct($number, $categoryName, $priority, $subject, $description, $milestoneName, $openerName, $openerEmail, $assigneeName, $assigneeEmail, $status, $commentCount, $attachmentCount, $createdAt, $updatedAt, $url, $apiUrl)
    {
        $this->number = $number;
        $this->categoryName = $categoryName;
        $this->priority = $priority;
        $this->subject = $subject;
        $this->description = $description;
        $this->milestoneName = $milestoneName;
        $this->openerName = $openerName;
        $this->openerEmail = $openerEmail;
        $this->assigneeName = $assigneeName;
        $this->assigneeEmail = $assigneeEmail;
        $this->status = $status;
        $this->commentCount = $commentCount;
        $this->attachmentCount = $attachmentCount;
        $this->createdAt = new Carbon($createdAt);
        $this->updatedAt = new Carbon($updatedAt);
        $this->url = $url;
        $this->apiUrl = $apiUrl;
    }

    /**
     * Get issue number
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Get category name of issue
     * @return string
     */
    public function getCategoryName()
    {
        return $this->categoryName;
    }

    /**
     * Get issue's priority level
     * @return mixed
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Get issue subject line
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Get description of issue
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get associated milestone name
     * @return string
     */
    public function getMilestoneName()
    {
        return $this->milestoneName;
    }

    /**
     * Get name of person who opened issue
     * @return string
     */
    public function getOpenerName()
    {
        return $this->openerName;
    }

    /**
     * Get email of person who opened issue
     * @return string
     */
    public function getOpenerEmail()
    {
        return $this->openerEmail;
    }

    /**
     * Get name of person assigned to issue
     * @return string
     */
    public function getAssigneeName()
    {
        return $this->assigneeName;
    }

    /**
     * Get email of person assigned to issue
     * @return string
     */
    public function getAssigneeEmail()
    {
        return $this->assigneeEmail;
    }

    /**
     * Get issue's status
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Get number of comments attached to issue
     * @return int
     */
    public function getCommentCount()
    {
        return $this->commentCount;
    }

    /**
     * Get number of attachments attached to issue
     * @return int
     */
    public function getAttachmentCount()
    {
        return $this->attachmentCount;
    }

    /**
     * Get date issue created
     * @return Carbon
     */
    public function getCreatedAt()
    {
        return $this->createdAt->copy();
    }

    /**
     * Get date issue last updated
     * @return Carbon
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt->copy();
    }

    /**
     * Get regular Sifter URL
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Get Sifter API Url
     * @return string
     */
    public function getApiUrl()
    {
        return $this->apiUrl;
    }






}