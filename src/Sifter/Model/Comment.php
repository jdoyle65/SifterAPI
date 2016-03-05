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
     * @param $body string Body of the comment
     * @param $priority string Priority of parent issue as of this comment
     * @param $status string Status of parent issue as of this comment
     * @param $category string Category of parent issue as of this comment
     * @param $commenter string Name of commenter
     * @param $commenterEmail string Email of commenter
     * @param $opener string Name of parent issue opener
     * @param $openerEmail string Email of parent issue opener
     * @param $project string Project name the parent issue belongs to as of this comment
     * @param $milestoneName string Milestone name the parent issue belongs to as of this comment
     * @param $assigneeName string Name of the assignee for the parent issue as of this comment
     * @param $assigneeEmail string Email of the assignee for the parent issue as of this comment
     * @param $createdAt string Datetime string comment created at
     * @param $updatedAt string Datetime string comment last updated at
     * @param $attachments array An array of attachments belonging to this comment
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