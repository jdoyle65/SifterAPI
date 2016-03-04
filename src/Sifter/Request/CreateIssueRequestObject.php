<?php namespace Sifter\Request;

class CreateIssueRequestObject {
    public $subject;
    public $body;
    public $assignee_name;
    public $priority_name;
    public $milestone_name;
    public $category_name;

    /**
     * CreateIssueRequestObject constructor.
     * @param $subject
     * @param $body
     * @param $assignee_name
     * @param $priority_name
     * @param $milestone_name
     * @param $category_name
     */
    public function __construct($subject, $body, $assignee_name, $priority_name, $milestone_name, $category_name)
    {
        $this->subject = $subject;
        $this->body = $body;
        $this->assignee_name = $assignee_name;
        $this->priority_name = $priority_name;
        $this->milestone_name = $milestone_name;
        $this->category_name = $category_name;
    }

    public function dataArray()
    {
        return array(
            'subject' => $this->subject,
            'body' => $this->body,
            'assignee_name' => $this->assignee_name,
            'priority_name' => $this->priority_name,
            'milestone_name' => $this->milestone_name,
            'category_name' => $this->category_name
        );
    }


}