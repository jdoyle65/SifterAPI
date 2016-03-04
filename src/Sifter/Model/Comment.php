<?php namespace Sifter\Model;

use Carbon\Carbon;

class Comment {
    private $body;
    private $priority;
    private $status;
    private $category;
    private $commenter;
    private $commenterEmail;
    private $opener;
    private $openerEmail;
    private $project;
    private $milestoneName;
    private $assigneeName;
    private $assigneeEmail;
    private $createdAt;
    private $updatedAt;
    private $attachments = array();

    /**
     * Comment constructor.
     * @param $body
     * @param $priority
     * @param $status
     * @param $category
     * @param $commenter
     * @param $commenterEmail
     * @param $opener
     * @param $openerEmail
     * @param $project
     * @param $milestoneName
     * @param $assigneeName
     * @param $assigneeEmail
     * @param $createdAt
     * @param $updatedAt
     * @param array $attachments
     */
    public function __construct($body, $priority, $status, $category, $commenter, $commenterEmail, $opener, $openerEmail, $project, $milestoneName, $assigneeName, $assigneeEmail, $createdAt, $updatedAt, array $attachments = array())
    {
        $this->body = $body;
        $this->priority = $priority;
        $this->status = $status;
        $this->category = $category;
        $this->commenter = $commenter;
        $this->commenterEmail = $commenterEmail;
        $this->opener = $opener;
        $this->openerEmail = $openerEmail;
        $this->project = $project;
        $this->milestoneName = $milestoneName;
        $this->assigneeName = $assigneeName;
        $this->assigneeEmail = $assigneeEmail;
        $this->createdAt = new Carbon($createdAt);
        $this->updatedAt = new Carbon($updatedAt);
        $this->attachments = $attachments;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
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
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @return mixed
     */
    public function getCommenter()
    {
        return $this->commenter;
    }

    /**
     * @return mixed
     */
    public function getCommenterEmail()
    {
        return $this->commenterEmail;
    }

    /**
     * @return mixed
     */
    public function getOpener()
    {
        return $this->opener;
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
    public function getProject()
    {
        return $this->project;
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
     * @return array
     */
    public function getAttachments()
    {
        return $this->attachments;
    }




}