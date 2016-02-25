<?php namespace Tests\Sifter;




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

    private function createSifterCurlCallbackClosure() {
        return function() {
            $args = func_get_args();
            $url = $args[0];
            switch ($url) {

                case self::$baseUrl . 'projects':
                    $this->sifterCurlMock->response = $this->jsonTestString('projects.json');
                    $this->sifterCurlMock->error = 0;
                    break;

                case self::$baseUrl . 'projects/1/issues':
                    $this->sifterCurlMock->response = $this->jsonTestString('projects_1_issues.json');
                    $this->sifterCurlMock->error = 0;
                    break;

                case self::$baseUrl . 'projects/1';
                    $this->sifterCurlMock->response = $this->jsonTestString('projects_1.json');
                    $this->sifterCurlMock->error = 0;
                    break;

                case self::$baseUrl . 'projects/1/milestones':
                    $this->sifterCurlMock->response = $this->jsonTestString('projects_1_milestones.json');
                    $this->sifterCurlMock->error = 0;
                    break;

                case self::$baseUrl . 'projects/1/categories':
                    $this->sifterCurlMock->response = $this->jsonTestString('projects_1_categories.json');
                    $this->sifterCurlMock->error = 0;
                    break;

                case self::$baseUrl . 'projects/1/people':
                    $this->sifterCurlMock->response = $this->jsonTestString('projects_1_people.json');
                    $this->sifterCurlMock->error = 0;
                    break;

                default:
                    break;
            }
        };
    }

    private function setUpSifterCurlMock()
    {
        $this->sifterCurlMock = $this->getMockBuilder('Sifter\SifterCurl')
            ->setConstructorArgs([self::$apiKey, self::$apiSubdomain])
            ->getMock();
        $this->sifterCurlMock
            ->method('getBaseUrl')
            ->willReturn(self::$baseUrl);

        // Set up the routes that are going to be called
        $sifterCurlCallback = $this->createSifterCurlCallbackClosure();

        $this->sifterCurlMock
            ->expects($this->any())
            ->method('get')
            ->will($this->returnCallback($sifterCurlCallback));
    }

    private function jsonTestString($filename)
    {
        return file_get_contents(__DIR__ . '/../json/' . $filename);
    }

}
