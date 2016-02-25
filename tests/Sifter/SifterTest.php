<?php namespace Tests\Sifter;


use Curl\Curl;
use josegonzalez\Dotenv\Loader;
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

    private function createSifterCallbackClosure() {
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
        $sifterCurlCallback = $this->createSifterCallbackClosure();

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
