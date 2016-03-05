<?php namespace Sifter;

use Sifter\Model\Attachment;
use Sifter\Model\Category;
use Sifter\Model\Comment;
use Sifter\Model\Issue;
use Sifter\Model\Milestone;
use Sifter\Model\Person;
use Sifter\Model\Project;
use Sifter\Resource\IssuesResource;

class JsonObjectHelpers
{

    static public function toProject($json)
    {
        if (is_string($json)) {
            $json = json_decode($json);
        }

        return new Project(
            $json->name,
            $json->primary_company_name,
            $json->archived,
            $json->url,
            $json->issues_url,
            $json->milestones_url,
            $json->api_url,
            $json->api_issues_url,
            $json->api_milestones_url,
            $json->api_categories_url,
            $json->api_people_url
        );
    }

    static public function toProjectsArray($json)
    {
        if (is_string($json)) {
            $json = json_decode($json);
        }

        $projects = array();
        if ( ! isset($json->projects) || ! is_array($json->projects)) {
            throw new \Exception('Projects were not returned');
        } else {
            foreach ($json->projects as $project) {
                $projects[] = self::toProject($project);
            }
            return $projects;
        }
    }

    static public function toIssue($json)
    {
        if(is_string($json)) {
            $json = json_decode($json);
        }

        return new Issue(
            $json->number,
            $json->category_name,
            $json->priority,
            $json->subject,
            $json->description,
            $json->milestone_name,
            $json->opener_name,
            $json->opener_email,
            $json->assignee_name,
            $json->assignee_email,
            $json->status,
            $json->comment_count,
            $json->attachment_count,
            $json->created_at,
            $json->updated_at,
            $json->url,
            $json->api_url
        );
    }

    static public function toIssuesResource($json)
    {
        if (is_string($json)) {
            $json = json_decode($json);
        }
        return new IssuesResource(
            $json->issues,
            $json->page,
            $json->per_page,
            $json->total_pages,
            $json->next_page_url,
            $json->previous_page_url
        );
    }

    static public function toMilestone($json)
    {
        if (is_string($json)) {
            $json = json_decode($json);
        }
        return new Milestone(
            $json->name,
            $json->due_date,
            $json->issues_url,
            $json->api_issues_url
        );
    }

    static public function toMilestonesArray($json)
    {
        if (is_string($json)) {
            $json = json_decode($json);
        }
        $milestones = array();

        if ( ! isset($json->milestones) || ! is_array($json->milestones)) {
            throw new \Exception('Milestones were not returned');
        } else {
            foreach ($json->milestones as $milestone) {
                $milestones[] = self::toMilestone($milestone);
            }
            return $milestones;
        }
    }

    static public function toCategory($json)
    {
        if (is_string($json)) {
            $json = json_decode($json);
        }
        return new Category(
            $json->name,
            $json->issues_url,
            $json->api_issues_url
        );
    }

    static public function toCategoriesArray($json)
    {
        if (is_string($json)) {
            $json = json_decode($json);
        }
        $categories = array();

        if ( ! isset($json->categories) || ! is_array($json->categories)) {
            throw new \Exception('Categories were not returned');
        } else {
            foreach ($json->categories as $category) {
                $categories[] = self::toCategory($category);
            }
            return $categories;
        }
    }

    static public function toPerson($json)
    {
        if (is_string($json)) {
            $json = json_decode($json);
        }
        return new Person(
            $json->username,
            $json->first_name,
            $json->last_name,
            $json->email,
            $json->issues_url,
            $json->api_issues_url
        );
    }

    static public function toPeopleArray($json)
    {
        if (is_string($json)) {
            $json = json_decode($json);
        }
        $people = array();

        if ( ! isset($json->people) || ! is_array($json->people)) {
            throw new \Exception('People were not returned');
        } else {
            foreach ($json->people as $person) {
                $people[] = self::toPerson($person);
            }
            return $people;
        }
    }

    static public function toComment($json)
    {
        if (is_string($json)) {
            $json = json_decode($json);
        }
        $attachments = array();
        if(isset($json->attachments) && !empty($json->attachments)) {
            $attachments = self::toAttachmentArray($json);
        }

        return new Comment(
            $json->body,
            $json->priority,
            $json->status,
            $json->category,
            $json->commenter,
            $json->commenter_email,
            $json->opener,
            $json->opener_email,
            $json->project,
            $json->milestone_name,
            $json->assignee_name,
            $json->assignee_email,
            $json->created_at,
            $json->updated_at,
            $attachments
        );
    }

    static public function toCommentsArrayFromIssueJson($json)
    {
        if (is_string($json)) {
            $json = json_decode($json);
        }
        return self::toCommentsArray($json->issue);
    }

    static public function toCommentsArray($json)
    {
        if (is_string($json)) {
            $json = json_decode($json);
        }
        $comments = array();

        if ( ! isset($json->comments) || ! is_array($json->comments)) {
            throw new \Exception('Comments were not returned');
        } else {
            foreach ($json->comments as $comment) {
                $comments[] = self::toComment($comment);
            }
            return $comments;
        }
    }

    static public function toStatusArray($json) {
        if (is_string($json)) {
            $json = json_decode($json);
        }

        return (array)$json->statuses;
    }

    static public function toPriorityArray($json) {
        if (is_string($json)) {
            $json = json_decode($json);
        }

        return (array)$json->priorities;
    }

    static public function toAttachmentArray($json) {
        if(is_string($json)) {
            $json = json_decode($json);
        }
        if(!isset($json->attachments) || !is_array($json->attachments)) {
            throw new \Exception('Attachments not found');
        }

        $attachments = array();
        foreach($json->attachments as $attachment) {
            $attachments[] = self::toAttachment($attachment);
        }
        return $attachments;
    }

    static public function toAttachment($json) {
        if(is_string($json)) {
            $json = json_decode($json);
        }

        return new Attachment(
            $json->filename,
            $json->size,
            $json->height,
            $json->width,
            $json->url,
            $json->thumb_url
        );
    }

}