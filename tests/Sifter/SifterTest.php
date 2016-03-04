<?php namespace Tests\Sifter;




use Sifter\Request\CreateIssueRequestObject;
use Sifter\Resource\IssuesResource;
use Sifter\Sifter;

class SifterTest extends \PHPUnit_Framework_TestCase
{
    private static $apiKey;
    private static $apiSubdomain;
    private static $baseUrl;
    private $sifterCurlMock;

    public static function setUpBeforeClass()
    {
        self::$apiKey = '1234';
        self::$apiSubdomain = 'example';
        self::$baseUrl = 'https://example.sifterapp.com/api/';
    }

    public function setUp()
    {
        parent::setUp();

        if ($this->sifterCurlMock === null) {
            $this->setUpSifterCurlMock();
        }
    }

    public function testEnvironmentSet()
    {
        $this->assertNotNull(self::$apiKey);
        $this->assertNotNull(self::$apiSubdomain);
    }

    public function testConstruct()
    {
        $sifter = new Sifter($this->sifterCurlMock);
    }

    public function testAllProjects()
    {
        $sifter = new Sifter($this->sifterCurlMock);
        $projects = $sifter->allProjects();

        $this->assertTrue(is_array($projects));
    }

    public function testProject()
    {

    }

    public function testIssuesThroughProject()
    {
        $sifter = new Sifter($this->sifterCurlMock);
        $projects = $sifter->allProjects();

        $this->assertTrue(is_array($projects));
        $this->assertNotEmpty($projects);

        /* @var $issues IssuesResource */
        $issues = $projects[0]->issues();

        $this->assertInstanceOf('Sifter\Resource\IssuesResource', $issues);
        $this->assertEquals(1, $issues->getPage());
        $this->assertEquals(100, $issues->getPerPage());
        $this->assertEquals(2, $issues->getTotalPages());
        $this->assertEquals('https://example.sifterapp.com/api/projects/1/issues?per_page=10&page=1', $issues->getNextPageUrl());
        $this->assertNull($issues->getPreviousPageUrl());
    }

    public function testIssueThroughProject() {
        $sifter = new Sifter($this->sifterCurlMock);
        $projects = $sifter->allProjects();

        $this->assertTrue(is_array($projects));
        $this->assertNotEmpty($projects);

        $issues = $projects[0]->issues();

        /* @var $issue \Sifter\Model\Issue */
        $issue = $issues->first();

        $this->assertInstanceOf('Sifter\Resource\IssuesResource', $issues);
        $this->assertInstanceOf('Sifter\Model\Issue', $issue);
        $this->assertInstanceOf('Carbon\Carbon', $issue->getCreatedAt());
        $this->assertInstanceOf('Carbon\Carbon', $issue->getUpdatedAt());
        $this->assertEquals(57, $issue->getNumber());
        $this->assertEquals('Enhancement', $issue->getCategoryName());
        $this->assertEquals('Trivial', $issue->getPriority());
        $this->assertEquals('Donec vel neque', $issue->getSubject());
        $this->assertEquals('Nam id libero quis ipsum feugiat elementum. Vivamus vitae mauris ut ipsum mattis malesuada. Sed vel massa. Mauris lobortis. Nunc egestas, massa id scelerisque dapibus, urna mi accumsan purus, vel aliquam nunc sapien eget nisi. Quisque vitae nibh. Proin interdum mollis leo. Fusce sed nisi. Integer ut tortor.', $issue->getDescription());
        $this->assertNull($issue->getMilestoneName());
        $this->assertEquals('Adam Keys', $issue->getOpenerName());
        $this->assertEquals('adam@example.com', $issue->getOpenerEmail());
        $this->assertEquals('Garrett Dimon', $issue->getAssigneeName());
        $this->assertEquals('garrett@example.com', $issue->getAssigneeEmail());
        $this->assertEquals(2, $issue->getCommentCount());
        $this->assertEquals(1, $issue->getAttachmentCount());
        $this->assertEquals('https://example.sifterapp.com/projects/1/issues/5', $issue->getUrl());
    }

    public function testMilestoneThroughProject() {
        $sifter = new Sifter($this->sifterCurlMock);
        $projects = $sifter->allProjects();

        $this->assertTrue(is_array($projects));
        $this->assertNotEmpty($projects);

        $milestones = $projects[0]->milestones();

        /* @var $milestone \Sifter\Model\Milestone */
        $milestone = $milestones[0];

        $this->assertEquals('Private Release', $milestone->getName());
        $this->assertEquals('2010-04-15', $milestone->getDueDate()->format('Y-m-d'));
        $this->assertEquals('https://example.sifterapp.com/projects/1/issues?m=1', $milestone->getIssuesUrl());
        $this->assertEquals('https://example.sifterapp.com/api/projects/1/issues?m=1', $milestone->getApiIssuesUrl());

    }

    public function testCategoryThroughProject() {
        $sifter = new Sifter($this->sifterCurlMock);
        $projects = $sifter->allProjects();

        $this->assertTrue(is_array($projects));
        $this->assertNotEmpty($projects);

        $categories = $projects[0]->categories();

        /* @var $category \Sifter\Model\Category */
        $category = $categories[0];

        $this->assertEquals('Bugs', $category->getName());
        $this->assertEquals('https://example.sifterapp.com/projects/1/issues?c=1', $category->getIssuesUrl());
        $this->assertEquals('https://example.sifterapp.com/api/projects/1/issues?c=1', $category->getApiIssuesUrl());

    }

    public function testPersonThroughProject() {
        $sifter = new Sifter($this->sifterCurlMock);
        $projects = $sifter->allProjects();

        $this->assertTrue(is_array($projects));
        $this->assertNotEmpty($projects);

        $people = $projects[0]->people();

        /* @var $person \Sifter\Model\Person */
        $person = $people[0];

        $this->assertEquals('gdimon', $person->getUsername());
        $this->assertEquals('Garrett', $person->getFirstName());
        $this->assertEquals('Dimon', $person->getLastName());
        $this->assertEquals('garrett@nextupdate.com', $person->getEmail());
        $this->assertEquals('https://example.sifterapp.com/projects/1/issues?a=1', $person->getIssuesUrl());
        $this->assertEquals('https://example.sifterapp.com/api/projects/1/issues?a=1', $person->getApiIssuesUrl());

    }

    public function testCommentsThroughIssue() {
        $sifter = new Sifter($this->sifterCurlMock);
        $projects = $sifter->allProjects();

        $this->assertTrue(is_array($projects));
        $this->assertNotEmpty($projects);

        $issues = $projects[0]->issues()->get();

        $this->assertNotEmpty($issues);
        $issue = $issues[1];
        $this->assertNotNull($issue);
        $this->assertEquals('https://example.sifterapp.com/api/projects/1/issues/6', $issue->getApiUrl());

        $comments = $issue->comments();
        $this->assertNotEmpty($comments);
        $comment = $comments[0];

        /* @var $comment \Sifter\Model\Comment */
        $this->assertEquals('Proin dictum dignissim metus. Vivamus vel risus sed augue venenatis sodales. Quisque tempus dictum lorem. Sed a turpis eu turpis lobortis pellentesque. Nunc sem mi, ullamcorper non, dignissim eu, pellentesque eget, justo. Donec mollis neque quis tortor. In hac habitasse platea dictumst. Mauris at velit non erat scelerisque iaculis.', $comment->getBody());
        $this->assertEquals('Trivial', $comment->getPriority());
        $this->assertEquals('Open', $comment->getStatus());
        $this->assertEquals('Bug', $comment->getCategory());
        $this->assertEquals('Adam Keys', $comment->getCommenter());
        $this->assertEquals('adam@example.com', $comment->getCommenterEmail());
        $this->assertEquals('Adam Keys', $comment->getOpener());
        $this->assertEquals('adam@example.com', $comment->getOpenerEmail());
        $this->assertNull($comment->getMilestoneName());
        $this->assertNull($comment->getAssigneeName());
        $this->assertNull($comment->getAssigneeEmail());
        $this->assertInstanceOf('Carbon\Carbon', $comment->getCreatedAt());
        $this->assertInstanceOf('Carbon\Carbon', $comment->getUpdatedAt());
        $this->assertEquals('2010/05/16 19:13:16', $comment->getCreatedAt()->format('Y/m/d H:i:s'));
        $this->assertEquals('2010/05/16 19:13:16', $comment->getUpdatedAt()->format('Y/m/d H:i:s'));
    }

    public function testCreateIssue() {
        $sifter = new Sifter($this->sifterCurlMock);
        $projects = $sifter->allProjects();

        $this->assertTrue(is_array($projects));
        $this->assertNotEmpty($projects);

        $issue = $projects[0]->createIssue(
            new CreateIssueRequestObject(
                'Sed lectus nunc, egestas tincidunt',
                'Proin dictum dignissim metus. Vivamus vel risus sed augue venenatis sodales. Quisque tempus dictum lorem. Sed a turpis eu turpis lobortis pellentesque. Nunc sem mi, ullamcorper non, dignissim eu, pellentesque eget, justo. Donec mollis neque quis tortor. In hac habitasse platea dictumst. Mauris at velit non erat scelerisque iaculis.',
                null,
                'Trivial',
                null,
                'Bug'
            )
        );
        /* @var $issue \Sifter\Model\Issue */
        $this->assertNotNull($issue);
        $this->assertEquals('https://example.sifterapp.com/api/projects/1/issues/6', $issue->getApiUrl());


        $this->assertEquals('Trivial', $issue->getPriority());
        $this->assertEquals('Open', $issue->getStatus());
        $this->assertEquals('Bug', $issue->getCategoryName());
        $this->assertNull($issue->getMilestoneName());
        $this->assertNull($issue->getAssigneeName());
        $this->assertInstanceOf('Carbon\Carbon', $issue->getCreatedAt());
        $this->assertInstanceOf('Carbon\Carbon', $issue->getUpdatedAt());
        $this->assertEquals('2010/05/16 19:13:16', $issue->getCreatedAt()->format('Y/m/d H:i:s'));
        $this->assertEquals('2010/05/16 19:13:16', $issue->getUpdatedAt()->format('Y/m/d H:i:s'));
    }

    public function createSifterCurlGetCallbackClosure() {
        $sifterCurlMock = $this->sifterCurlMock;
        $baseUrl = self::$baseUrl;
        $that = $this;

        return function() use ($baseUrl, $sifterCurlMock, $that) {
            $args = func_get_args();
            $url = $args[0];
            switch ($url) {

                case $baseUrl . 'projects':
                    $sifterCurlMock->response = $that->jsonTestString('projects.json');
                    $sifterCurlMock->error = 0;
                    break;

                case $baseUrl . 'projects/1/issues':
                    $sifterCurlMock->response = $that->jsonTestString('projects_1_issues.json');
                    $sifterCurlMock->error = 0;
                    break;

                case $baseUrl . 'projects/1';
                    $sifterCurlMock->response = $that->jsonTestString('projects_1.json');
                    $sifterCurlMock->error = 0;
                    break;

                case $baseUrl . 'projects/1/milestones':
                    $sifterCurlMock->response = $that->jsonTestString('projects_1_milestones.json');
                    $sifterCurlMock->error = 0;
                    break;

                case $baseUrl . 'projects/1/categories':
                    $sifterCurlMock->response = $that->jsonTestString('projects_1_categories.json');
                    $sifterCurlMock->error = 0;
                    break;

                case $baseUrl . 'projects/1/people':
                    $sifterCurlMock->response = $that->jsonTestString('projects_1_people.json');
                    $sifterCurlMock->error = 0;
                    break;

                case $baseUrl . 'projects/1/issues/6':
                    $sifterCurlMock->response = $that->jsonTestString('projects_1_issues_6.json');
                    $sifterCurlMock->error = 0;
                    break;

                default:
                    break;
            }
        };
    }

    public function createSifterCurlPostCallbackClosure() {
        $sifterCurlMock = $this->sifterCurlMock;
        $baseUrl = self::$baseUrl;
        $that = $this;

        return function() use ($baseUrl, $sifterCurlMock, $that) {
            $args = func_get_args();
            $url = $args[0];
            switch ($url) {

                case $baseUrl . 'projects/1/issues':
                    $sifterCurlMock->response = $that->jsonTestString('projects_1_issues_6.json');
                    $sifterCurlMock->error = 0;
                    break;

                default:
                    break;
            }
        };
    }

    public function setUpSifterCurlMock()
    {
        $this->sifterCurlMock = $this->getMockBuilder('Sifter\SifterCurl')
            ->setConstructorArgs(array(self::$apiKey, self::$apiSubdomain))
            ->getMock();
        $this->sifterCurlMock
            ->method('getBaseUrl')
            ->willReturn(self::$baseUrl);

        // Set up the routes that are going to be called
        $sifterCurlCallback = $this->createSifterCurlGetCallbackClosure();

        $this->sifterCurlMock
            ->expects($this->any())
            ->method('get')
            ->will($this->returnCallback($sifterCurlCallback));

        // Set up the routes that are going to be called
        $sifterCurlCallback = $this->createSifterCurlPostCallbackClosure();

        $this->sifterCurlMock
            ->expects($this->any())
            ->method('post')
            ->will($this->returnCallback($sifterCurlCallback));
    }

    public function jsonTestString($filename)
    {
        return file_get_contents(__DIR__ . '/../json/' . $filename);
    }

}
