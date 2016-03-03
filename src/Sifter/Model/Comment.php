<?php namespace Sifter\Model;

use Carbon\Carbon;

class Comment {
    private $body;
    private $commenter;
    private $commenterEmail;
    private $createdAt;
    private $updatedAt;
    private $attachments = array();

    // TODO Include milestone, status, etc.
    /**
     * Comment constructor.
     * @param $body Body of the comment
     * @param $commenter Name of person that made comment
     * @param $commenterEmail Email of person that made comment
     * @param $createdAt Date created at
     * @param $updatedAt Date updated at
     * @param array $attachments Array of attachments in this comment
     */
    public function __construct($body, $commenter, $commenterEmail, $createdAt, $updatedAt, array $attachments = array())
    {
        $this->body = $body;
        $this->commenter = $commenter;
        $this->commenterEmail = $commenterEmail;
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