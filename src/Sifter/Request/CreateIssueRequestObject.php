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
     * @param $subject string Title of the issue
     * @param $body string Description of the issue
     * @param $assignee_name string Full name of person to assign issue to
     * @param $priority_name string Priority to assign issue
     * @param $milestone_name string Milestone to assign issue
     * @param $category_name string Category to assign issue
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

    /**
     * Get the array data needed to pass to SifterCurl's post function
     * @return array
     */
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