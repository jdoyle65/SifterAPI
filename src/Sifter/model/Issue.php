<?php namespace Sifter\Model;

use Carbon\Carbon;

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
     * @param $number
     * @param $categoryName
     * @param $priority
     * @param $subject
     * @param $description
     * @param $milestoneName
     * @param $openerName
     * @param $openerEmail
     * @param $assigneeName
     * @param $assigneeEmail
     * @param $status
     * @param $commentCount
     * @param $attachmentCount
     * @param $createdAt
     * @param $updatedAt
     * @param $url
     * @param $apiUrl
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
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @return mixed
     */
    public function getCategoryName()
    {
        return $this->categoryName;
    }

    /**
     * @return mixed
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getMilestoneName()
    {
        return $this->milestoneName;
    }

    /**
     * @return mixed
     */
    public function getOpenerName()
    {
        return $this->openerName;
    }

    /**
     * @return mixed
     */
    public function getOpenerEmail()
    {
        return $this->openerEmail;
    }

    /**
     * @return mixed
     */
    public function getAssigneeName()
    {
        return $this->assigneeName;
    }

    /**
     * @return mixed
     */
    public function getAssigneeEmail()
    {
        return $this->assigneeEmail;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return mixed
     */
    public function getCommentCount()
    {
        return $this->commentCount;
    }

    /**
     * @return mixed
     */
    public function getAttachmentCount()
    {
        return $this->attachmentCount;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt->copy();
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt->copy();
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }




}